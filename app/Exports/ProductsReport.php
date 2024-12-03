<?php

namespace App\Exports;

use App\Models\Products\Product;
use App\Models\Orders\Order;
use App\Models\Archives\ArchivedProduct;
use App\Models\Customizations\Customization;
use App\Models\Customizations\CustomizationOption;
use App\Models\Customizations\CustomizationSelection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductsReport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'Producto',
            'Ventas Totales',
            'Ingresos Totales',
            'Personalizaciones Más Solicitadas',
            'Estado',
        ];
    }

    public function collection()
    {
        // Consulta para productos activos
        $activeCustomizationCounts = DB::table('customization_selection')
            ->select(
                'order_product.product_id',
                'customizations.name as customization_name',
                'customization_option.option_name',
                DB::raw('COUNT(*) as selection_count')
            )
            ->join('order_product', 'customization_selection.order_product_id', '=', 'order_product.id')
            ->join('customization_option', 'customization_selection.customization_option_id', '=', 'customization_option.id')
            ->join('customizations', 'customization_option.customization_id', '=', 'customizations.id')
            ->groupBy('order_product.product_id', 'customizations.name', 'customization_option.option_name');

        // Consulta para productos archivados
        $archivedCustomizationCounts = DB::table('archived_customization_selection')
            ->select(
                'archived_order_product.product_id',
                'customizations.name as customization_name',
                'customization_option.option_name',
                DB::raw('COUNT(*) as selection_count')
            )
            ->join('archived_order_product', 'archived_customization_selection.order_product_id', '=', 'archived_order_product.id')
            ->join('customization_option', 'archived_customization_selection.customization_option_id', '=', 'customization_option.id')
            ->join('customizations', 'customization_option.customization_id', '=', 'customizations.id')
            ->groupBy('archived_order_product.product_id', 'customizations.name', 'customization_option.option_name');

        $activeProducts = Product::select(
            'products.name',
            DB::raw('COUNT(DISTINCT order_product.id) as total_sales'),
            DB::raw('COALESCE(SUM(order_product.total_price), 0) as total_revenue'),
            DB::raw('(
                SELECT GROUP_CONCAT(
                    CONCAT(
                        c.customization_name,
                        " (",
                        c.selection_count,
                        " veces: ",
                        c.option_name,
                        ")"
                    ) SEPARATOR ", "
                )
                FROM (' . $activeCustomizationCounts->toSql() . ') as c
                WHERE c.product_id = products.id
            ) as customizations'),
            DB::raw("'Activo' as status")
        )
        ->leftJoin('order_product', 'products.id', '=', 'order_product.product_id')
        ->mergeBindings($activeCustomizationCounts)
        ->groupBy('products.id', 'products.name')
        ->get();

        // Productos archivados
        $archivedProducts = collect();
        if (Schema::hasTable('archived_products')) {
            $archivedProducts = ArchivedProduct::select(
                'archived_products.name',
                DB::raw('COUNT(DISTINCT archived_order_product.id) as total_sales'),
                DB::raw('COALESCE(SUM(archived_order_product.total_price), 0) as total_revenue'),
                DB::raw('(
                    SELECT GROUP_CONCAT(
                        CONCAT(
                            c.customization_name,
                            " (",
                            c.selection_count,
                            " veces: ",
                            c.option_name,
                            ")"
                        ) SEPARATOR ", "
                    )
                    FROM (' . $archivedCustomizationCounts->toSql() . ') as c
                    WHERE c.product_id = archived_products.id
                ) as customizations'),
                DB::raw("'Archivado' as status")
            )
            ->leftJoin('archived_order_product', 'archived_products.id', '=', 'archived_order_product.product_id')
            ->mergeBindings($archivedCustomizationCounts)
            ->groupBy('archived_products.id', 'archived_products.name')
            ->get();
        }

        return $activeProducts->concat($archivedProducts)
            ->sortByDesc('total_sales')
            ->map(function ($product) {
                // Formatear los ingresos como moneda
                $product->total_revenue = 'CLP ' . number_format($product->total_revenue, 0, ',', '.');
                // Si las personalizaciones son null, mostrar 'Sin personalizaciones'
                $product->customizations = $product->customizations ?? 'Sin personalizaciones';
                return $product;
            })
            ->values();
    }
}