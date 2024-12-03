<?php

namespace App\Observers;

use App\Models\Auth\User;
use App\Models\Materials\Material;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MaterialObserver
{
    /**
     * Handle the Material "created" event.
     */
    public function created(Material $material): void
    {
        //
    }

    /**
     * Handle the Material "updated" event.
     */
    public function updated(Material $material): void
    {   
        try {
            // Solo proceder si la cantidad en stock ha cambiado
            if ($material->wasChanged('quantity_in_stock')) {
                Log::info("Cantidad en stock cambió de {$material->getOriginal('quantity_in_stock')} a {$material->quantity_in_stock}");
                
                // Obtener el total de compras (Purchase)
                $totalPurchases = DB::table('inventory_change')
                    ->where('material_id', $material->id)
                    ->where('transaction_type', 'Purchase')
                    ->sum('quantity');

                Log::info("Total de compras: {$totalPurchases}");

                // Obtener el total de ajustes y producción (que son negativos)
                $totalReductions = DB::table('inventory_change')
                    ->where('material_id', $material->id)
                    ->whereIn('transaction_type', ['Adjustment', 'Production'])
                    ->sum('quantity');
                
                Log::info("Total de reducciones: {$totalReductions}");

                // El stock efectivo es el stock actual real
                $effectiveStock = $totalPurchases + $totalReductions;
                Log::info("Stock efectivo: {$effectiveStock}");

                // Calculamos el porcentaje basado en el total de compras, no en el stock efectivo
                $percentage = ($material->quantity_in_stock / $totalPurchases) * 100;
                Log::info("Porcentaje actual respecto al total de compras: {$percentage}%");

                // Si hay compras y la cantidad actual es menor o igual al 20% del total de compras
                if ($totalPurchases > 0 && $material->quantity_in_stock <= $totalPurchases * 0.2) {
                    Log::info("Se cumple la condición de stock bajo (stock <= 20% del total de compras)");
                    // Obtener el administrador
                    $admin = User::where('role', 'A')->first();
                    
                    if ($admin) {
                        Log::info("Intentando enviar correo a: {$admin->email}");

                        try {
                            Mail::send('emails.low-stock-alert', [
                                'material' => $material,
                                'currentStock' => $material->quantity_in_stock,
                                'effectiveStock' => $effectiveStock,
                                'totalPurchases' => $totalPurchases,
                                'totalReductions' => abs($totalReductions), // Lo convertimos a positivo para la vista
                                'percentage' => round($percentage, 2)
                            ], function($message) use ($admin, $material) {
                                $message->to($admin->email)
                                        ->subject('¡Alerta de Stock Bajo! - ' . $material->name);
                            });

                            Log::info("Correo enviado exitosamente");
                        } catch (\Exception $e) {
                            Log::error("Error al enviar el correo: " . $e->getMessage());
                            Log::error("Stack trace: " . $e->getTraceAsString());
                        }
                    } else {
                        Log::warning("No se encontró un administrador con correo válido");
                    }
                } else {
                    Log::info("No se cumple la condición de stock bajo (stock > 20% del total de compras)");
                }
            } else {
                Log::info("La cantidad en stock no cambió");
            }
        } catch (\Exception $e) {
            Log::error("Error general en el observer: " . $e->getMessage());
            Log::error("Stack trace: " . $e->getTraceAsString());
        }
    }

    /**
     * Handle the Material "deleted" event.
     */
    public function deleted(Material $material): void
    {
        //
    }

    /**
     * Handle the Material "restored" event.
     */
    public function restored(Material $material): void
    {
        //
    }

    /**
     * Handle the Material "force deleted" event.
     */
    public function forceDeleted(Material $material): void
    {
        //
    }
}
