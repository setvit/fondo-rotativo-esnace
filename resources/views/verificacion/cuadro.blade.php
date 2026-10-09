<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación SYED-ARE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            max-width: 650px;
            margin: 40px auto;
            border: 2px solid #16a34a;
            border-radius: 8px;
        }
        .header { text-align: center; }
        .ok { color: #16a34a; font-size: 28px; margin: 10px 0; }
        .dato { margin: 12px 0; font-size: 16px; }
        .label { font-weight: bold; color: #333; }
        .hash { font-size: 10px; color: #666; word-break: break-all; background: #f3f4f6; padding: 8px; border-radius: 4px; }
        hr { border: none; border-top: 1px solid #ddd; margin: 20px 0; }
        .footer { font-size: 12px; color: #666; text-align: center; margin-top: 25px; }
    </style>
</head>
<body>
    <div class="header">
        <h2 class="ok">✓ Documento Válido</h2>
        <p>Sistema de Verificación SYED-ARE</p>
    </div>
    <hr>
    <div class="dato"><span class="label">Código de Verificación:</span> {{ $cuadro->codigo_verificacion }}</div>
    <div class="dato"><span class="label">Comisión:</span> {{ $cuadro->comision->codigo }}</div>
    <div class="dato"><span class="label">Destino:</span> {{ $cuadro->comision->destino }}</div>
    <div class="dato"><span class="label">Fecha Salida:</span> {{ \Carbon\Carbon::parse($cuadro->comision->fecha_salida)->format('d/m/Y') }}</div>
    <div class="dato"><span class="label">Fecha Retorno:</span> {{ \Carbon\Carbon::parse($cuadro->comision->fecha_retorno)->format('d/m/Y') }}</div>
    <div class="dato"><span class="label">Generado el:</span> {{ $cuadro->created_at->format('d/m/Y H:i:s') }}</div>
    <hr>
    <div class="dato"><span class="label">Hash SHA256:</span></div>
    <div class="hash">{{ $cuadro->hash_documento }}</div>
    
    <div class="footer">
        Si los datos del PDF impreso no coinciden con estos, el documento fue alterado.
    </div>
</body>
</html>