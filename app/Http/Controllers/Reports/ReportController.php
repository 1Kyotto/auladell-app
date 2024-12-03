<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Exports\ProductsReport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Product;
use App\Models\Order;
use App\Models\ArchivedProduct;
use Illuminate\Http\Request;

class ReportController
{
    public function generateReport(Request $request)
    {
        $format = $request->input('format', 'excel');
        
        if ($format === 'excel') {
            return Excel::download(new ProductsReport, 'reporte_productos.xlsx');
        }
    }
}