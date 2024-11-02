<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            /* Personaliza el estilo del correo aquí */
            body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
            .email-container { background-color: #ffffff; padding: 20px; border-radius: 8px; }
            .email-header { font-size: 24px; font-weight: bold; }
            .email-body { margin-top: 20px; font-size: 16px; }
            .email-button { margin-top: 20px; }
            .email-footer { margin-top: 30px; font-size: 14px; color: #888888; }
        </style>
    </head>
    <body>
        <div class="email-container">
            <div class="email-header">
                Restablecimiento de contraseña
            </div>
            <div class="email-body">
                Hola, {{ $user->name }}!
                <br><br>
                Recibimos una solicitud para restablecer tu contraseña. Haz clic en el siguiente enlace para restablecerla:
                <br><br>
                <a href="{{ $resetUrl }}" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">
                    Restablecer Contraseña
                </a>
                <br><br>
                Este enlace de restablecimiento expirará en 60 minutos.
                <br><br>
                Si no solicitaste un restablecimiento de contraseña, puedes ignorar este correo.
            </div>
            <div class="email-footer">
                Gracias,<br>
                Auladell Joyas
            </div>
        </div>
    </body>
</html>