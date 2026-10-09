PAQUETE LIQUIDACIÓN FONDO ROTATIVO ESNACE - TNFG-IG-IF TUSA VITAR
========================================================================
Estado actual: Asignado $10,000 / Ejecutado $9,563.42 (con cargo Kiwi $350 BUSAN) / Saldo $436.58 / 95.63%
Incluye 5 comisiones + cargo adicional Kiwi BUSAN COM-20260925151104

INSTALACIÓN - COPIAR Y PEGAR:

cd /opt/homebrew/var/www/fondo-rotativo-esnace/

# 1. MIGRACIONES
cp database/migrations/2026_09_28_100000_create_liquidaciones_tables.php  /opt/homebrew/var/www/fondo-rotativo-esnace/database/migrations/
cp database/migrations/2026_09_28_add_cargo_kiwi_busan.php /opt/homebrew/var/www/fondo-rotativo-esnace/database/migrations/
php artisan migrate

# 2. MODELOS
cp app/Models/Liquidacion.php /opt/homebrew/var/www/fondo-rotativo-esnace/app/Models/
cp app/Models/MovimientoFondo.php /opt/homebrew/var/www/fondo-rotativo-esnace/app/Models/MovimientoFondo.php

# 3. CONTROLADOR
cp app/Http/Controllers/LiquidacionController.php /opt/homebrew/var/www/fondo-rotativo-esnace/app/Http/Controllers/

# 4. VISTAS - Crear carpeta si no existe
mkdir -p /opt/homebrew/var/www/fondo-rotativo-esnace/resources/views/liquidaciones
cp resources/views/liquidaciones/* /opt/homebrew/var/www/fondo-rotativo-esnace/resources/views/liquidaciones/

# 5. RUTAS - Agregar contenido de scripts/ROUTES.txt a routes/web.php
cat scripts/ROUTES.txt

# 6. REGISTRAR CARGO ADICIONAL $350 BUSAN (si aún no lo hizo)
# Opción SQL directa:
mysql -u root -p fondo_rotativo -e "
INSERT INTO movimientos_fondos (fondo_reparto_id, comision_id, codigo_comision, valor_pasaje, saldo_anterior, saldo_nuevo, tipo_movimiento, motivo_ajuste, plataforma, valor_original, user_id, created_at, updated_at)
VALUES (1, (SELECT id FROM comisiones WHERE codigo='COM-20260925151104'), 'COM-20260925151104', 350.00, 786.58, 436.58, 'CARGO_ADICIONAL_KIWI', 'Cobro adicional Kiwi tasas BUSAN', 'KIWI', 5438.70, 1, NOW(), NOW());
UPDATE control_fondo SET monto_ejecutado=9563.42, saldo_disponible=436.58, porcentaje_ejecutado=95.63 WHERE id=1;
UPDATE comisiones SET total_valor_pasajes=5788.70 WHERE codigo='COM-20260925151104';
"

# 7. LIMPIAR
php artisan view:clear
php artisan config:clear

# 8. PROBAR
# Ir a http://localhost:8000/liquidaciones
# Crear liquidación con las 5 comisiones
# PDF ESNACE Desglosado: /liquidaciones/{id}/pdf

ARCHIVOS INCLUIDOS:
- 2026_09_28_100000_create_liquidaciones_tables.php : tabla liquidaciones + liquidacion_comision
- 2026_09_28_add_cargo_kiwi_busan.php : agrega tipo_movimiento CARGO_ADICIONAL_KIWI
- Liquidacion.php : Modelo
- MovimientoFondo.php : Actualizado con CARGO_ADICIONAL_KIWI
- LiquidacionController.php : Controlador completo
- LiquidacionController_ESNACE_METODO_PDF.php : Método pdf() con estado de cuenta cronológico (usar para reemplazar método pdf en controlador)
- index.blade.php : Dashboard $10k / 95.63%
- create.blade.php : Selección por compra (incluye por viajar)
- show.blade.php : Detalle liquidación
- pdf.blade.php : PDF simple por compra
- pdf_estado_cuenta_ESNACE_DESGLOSADO.blade.php : PDF DESGLOSADO ESNACE con saldo inicial, compras con fechas, destinos, pasajeros, N° cotizaciones, cuadro ARE, valor pagado, cargo adicional Kiwi, saldo anterior/nuevo
- cargo-kiwi-busan.blade.php : Formulario registrar cargo
- registrar_cargo_busan_350.php : Script tinker
- ROUTES.txt : Rutas

PDF ESNACE DESGLOSADO INCLUYE:
- Saldo inicial $10,000
- Tabla cronológica con fecha compra, código comisión, destino, tipo, pasajeros, cuadro ARE, N° cotizaciones (3), valor pagado, cargo adicional Kiwi $350, valor final, saldo anterior, saldo nuevo
- Detalle por comisión con desglose $5,438.70 + $350 = $5,788.70 BUSAN
- Nota justificativa Art. 43 Reglamento Fondos Rotativos
- Firmas TNFG-IG-IF TUSA VITAR / TNNV-AB LOPEZ LUIS / COMANDANTE ESNACE
