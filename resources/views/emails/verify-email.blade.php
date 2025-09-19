<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar dirección de correo electrónico</title>
</head>

<body style="margin:0; padding:0; background-color:#f0f9ff; font-family: Arial, Helvetica, sans-serif;">
    <div style="display:flex; flex-direction:column; align-items:center; justify-content:center; width:100%; padding:20px;">
        <div style="width:120px; height:120px; margin-bottom:20px;">
            <img src="{{ asset('images/LogoFacturacion.png') }}" alt="Logo" style="max-width:100%; height:auto; display:block; margin:0 auto;" />
        </div>
        <div style="width:90%; max-width:600px; background-color:#ffffff; border:2px solid #082f49; border-radius:12px; box-shadow:0 4px 6px rgba(0,0,0,0.1); padding:30px; text-align:left;">
            <h1 style="font-size:24px; font-weight:bold; margin-bottom:20px; text-align:center;">Hola {{ $user->user_name }}</h1>
            <p style="font-size:16px; color:#111827; margin-bottom:30px; text-align:center;">
                Por favor haz clic en el botón de abajo para verificar tu dirección de correo electrónico.
            </p>
            <div style="text-align:center; margin-bottom:30px;">
                <a href="{{ $url }}"
                    style="background-color:#082f49; color:#ffffff; padding:12px 24px; border-radius:6px; text-decoration:none; font-size:16px; font-weight:bold; display:inline-block;">
                    Verificar correo
                </a>
            </div>
            <hr style="border:0; border-top:1px solid #e5e7eb; margin:30px 0;">
            <p style="font-size:14px; color:#374151; margin-bottom:20px;">
                Si tienes problemas para hacer clic en el botón <b>"Verificar correo"</b>, copia y pega la siguiente URL en tu navegador web:
            </p>
            <p style="font-size:14px; word-break:break-all; margin-bottom:30px; text-align:center;">
                <a href="{{ $url }}" style="color:#082f49; text-decoration:underline;">{{ $url }}</a>
            </p>
            <p style="font-size:14px; color:#6b7280; text-align:center;">
                Este es un correo electrónico generado automáticamente. Si no solicitaste este correo, simplemente ignóralo.
            </p>
        </div>
    </div>
</body>

</html>