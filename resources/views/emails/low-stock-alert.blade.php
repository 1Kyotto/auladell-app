<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body style="font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; line-height: 1.5; color: rgb(55, 65, 81); margin: 0; padding: 0;">
        <div style="max-width: 600px; margin: 20px auto; padding: 20px;">
            <!-- Header -->
            <div style="background-color: rgb(239, 68, 68); color: white; padding: 1rem; text-align: center; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                <h2 class="flex items-center gap-3 justify-center" style="margin: 0; font-size: 1.5rem; font-weight: 600;">
                    ⚠️ Alerta de Stock Bajo
                </h2>
            </div>
            
            <!-- Content -->
            <div style="background-color: rgb(249, 250, 251); padding: 1.5rem; border-radius: 0.5rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);">
                <p style="margin-bottom: 1rem;">Se ha detectado un nivel bajo de stock para el siguiente material:</p>
                
                <!-- Material Info Box -->
                <div style="background-color: white; padding: 1.25rem; border-radius: 0.5rem; border-left: 4px solid rgb(239, 68, 68); margin-bottom: 1.5rem; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);">
                    <h3 style="margin: 0 0 1rem 0; color: rgb(17, 24, 39); font-size: 1.25rem;">{{ $material->name }}</h3>
                    <p style="margin: 0.5rem 0;"><span style="font-weight: 600;">Descripción:</span> {{ $material->description ?: 'No disponible' }}</p>
                    <p style="margin: 0.5rem 0;"><span style="font-weight: 600;">Stock Actual:</span> {{ $currentStock }} {{ $material->unit }}</p>
                    <p style="margin: 0.5rem 0;"><span style="font-weight: 600;">Stock Efectivo Total:</span> {{ $effectiveStock }} {{ $material->unit }}</p>
                    <p style="margin: 0.5rem 0;"><span style="font-weight: 600;">Porcentaje Actual:</span> {{ $percentage }}%</p>
                </div>

                <!-- Movement Details -->
                <h4 style="color: rgb(17, 24, 39); font-size: 1.125rem; margin: 1.5rem 0 1rem;">Desglose de Movimientos:</h4>
                <div style="background-color: white; padding: 1.25rem; border-radius: 0.5rem; border-left: 4px solid rgb(239, 68, 68); margin-bottom: 1.5rem; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);">
                    <p style="margin: 0.5rem 0;"><span style="font-weight: 600;">Total Compras:</span> {{ $totalPurchases }} {{ $material->unit }}</p>
                    <p style="margin: 0.5rem 0;"><span style="font-weight: 600;">Total Reducciones:</span> {{ $totalReductions }} {{ $material->unit }}</p>
                    <p style="margin: 0.5rem 0; color: rgb(107, 114, 128); font-size: 0.875rem;">(Incluye ajustes y uso en producción)</p>
                </div>

                <!-- Warning Message -->
                <p style="color: rgb(239, 68, 68); font-weight: 600; text-align: center; margin: 1.5rem 0; padding: 1rem; background-color: rgb(254, 242, 242); border-radius: 0.5rem;">
                    Se recomienda revisar el inventario y considerar realizar un nuevo pedido.
                </p>
            </div>

            <!-- Footer -->
            <div style="text-align: center; margin-top: 1.5rem; color: rgb(107, 114, 128); font-size: 0.875rem;">
                <p style="margin: 0.5rem 0;">Este es un mensaje automático del sistema de gestión de inventario.</p>
                <p style="margin: 0.5rem 0;">Por favor, no responda a este correo.</p>
            </div>
        </div>
    </body>
</html>