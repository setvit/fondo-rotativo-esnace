-- CARGO ADICIONAL KIWI $350 - BUSAN COM-20260925151104
-- BD: fondo_rotativo_esnace - ANTES 9213.42/92.13/786.58 -> DESPUES 9563.42/95.63/436.58
INSERT INTO movimientos_fondos (fondo_reparto_id, comision_id, codigo_comision, valor_pasaje, saldo_anterior, saldo_nuevo, tipo_movimiento, motivo_ajuste, plataforma, valor_original, user_id, created_at, updated_at)
VALUES (1, (SELECT id FROM comisiones WHERE codigo='COM-20260925151104'), 'COM-20260925151104', 350.00, 786.58, 436.58, 'CARGO_ADICIONAL_KIWI', 'Cobro adicional Kiwi tasas BUSAN GUAYAQUIL-BUSAN-GUAYAQUIL', 'KIWI', 5438.70, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE valor_pasaje=VALUES(valor_pasaje);

UPDATE control_fondo SET monto_ejecutado=9563.42, saldo_disponible=436.58, porcentaje_ejecutado=95.63 WHERE id=1;
UPDATE comisiones SET total_valor_pasajes=5788.70 WHERE codigo='COM-20260925151104';
SELECT 'VERIFICACION FINAL' as check_final, monto_asignado, monto_ejecutado, saldo_disponible, porcentaje_ejecutado FROM control_fondo;
SELECT codigo, destino, total_valor_pasajes FROM comisiones WHERE codigo='COM-20260925151104';
