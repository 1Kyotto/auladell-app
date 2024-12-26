@extends('template.dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8 text-cblack-500">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Reportes Estadísticos</h2>
            
            <div class="flex w-full items-center justify-center gap-6">
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                    <h3 class="text-xl font-semibold mb-4 text-gray-700">
                        <i class="fas fa-file-excel text-green-600 mr-2"></i>
                        Reporte Excel
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Descarga un reporte detallado que incluye:
                        <ul class="list-disc ml-5 mt-2 space-y-1 mb-8">
                            <li>Productos más vendidos</li>
                            <li>Ingresos por producto</li>
                            <li>Personalizaciones populares</li>
                            <li>Estadísticas de productos activos y archivados</li>
                        </ul>
                    </p>
                    <a href="{{ route('admin.reports.generate', ['format' => 'excel']) }}"
                    class="inline-block bg-[#006C55] text-white px-6 py-2 rounded-md hover:bg-[#005543] transition-colors">
                        <i class="fas fa-download mr-2"></i>
                        Descargar Excel
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection