<?php

namespace App\Http\Controllers\Materials;

use App\Models\Materials\Material;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MaterialController
{
    public function index()
    {
        $materials = Material::orderBy('created_at', 'desc')->paginate(10);
        $items = Material::count();
        $actives = Material::whereNotNull('quantity_in_stock')->where('quantity_in_stock', '>', 0)->count();

        return view('dashboard.material', compact('materials', 'items', 'actives'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_unit' => 'required|numeric|min:0',
            'quantity_in_stock' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
        ]);

        Material::create($validated);

        return redirect()->route('admin.materials')->with('success', 'Material creado exitosamente');
    }

    public function update(Request $request, Material $material)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_unit' => 'required|numeric|min:0',
            'quantity_in_stock' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
        ]);

        // Calcular la diferencia en la cantidad
        $quantityDifference = $validated['quantity_in_stock'] - $material->quantity_in_stock;

        // Si la nueva cantidad es mayor que la anterior, es una compra
        if ($validated['quantity_in_stock'] > $material->quantity_in_stock) {
            DB::table('inventory_change')->insert([
                'material_id' => $material->id,
                'performed_by' => Auth::id(),
                'quantity' => $quantityDifference,
                'transaction_type' => 'Purchase',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        } 
        // Si la nueva cantidad es menor, es un ajuste
        else if ($validated['quantity_in_stock'] < $material->quantity_in_stock) {
            DB::table('inventory_change')->insert([
                'material_id' => $material->id,
                'performed_by' => Auth::id(),
                'quantity' => $quantityDifference,
                'transaction_type' => 'Adjustment',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        $material->update($validated);

        return redirect()->route('admin.materials')->with('success', 'Material actualizado exitosamente');
    }

    public function edit(Material $material)
    {
        return response()->json($material);
    }
}
