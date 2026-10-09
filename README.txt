PAQUETE FINAL LISTO PARA EJECUTAR - TODO AUTOMATICO
=============================================
BD: fondo_rotativo_esnace
USER: root
PASS: Ciber.2026
Estado actual: $10,000 / $9,213.42 (92.13%) / $786.58
Estado final: $10,000 / $9,563.42 (95.63%) / $436.58
COM-20260925151104 BUSAN: $5,438.70 -> $5,788.70 (+$350 Kiwi)

CONTENIDO:
- database/migrations/ (2 migraciones)
- app/Models/ (Liquidacion.php, MovimientoFondo.php con CARGO_ADICIONAL_KIWI)
- app/Http/Controllers/ (LiquidacionController.php con PDF desglosado ESNACE)
- resources/views/liquidaciones/ (6 vistas: index, create, show, pdf, pdf_estado_cuenta_ESNACE_DESGLOSADO, cargo-kiwi-busan)
- scripts/ (ROUTES.txt, registrar_cargo_busan_FINAL.sql)
- INSTALAR_TODO.sh (TODO EN UNO)

INSTALACION EN 1 COMANDO:
cd /opt/homebrew/var/www/fondo-rotativo-esnace/
unzip -o ~/Downloads/PAQUETE_FINAL_LISTO_EJECUTAR.zip
chmod +x PAQUETE_FINAL_LISTO_EJECUTAR/INSTALAR_TODO.sh
./PAQUETE_FINAL_LISTO_EJECUTAR/INSTALAR_TODO.sh

Eso hace:
1. Backup automatico en ~/BACKUP_FONDO_ROTATIVO_*/fondo_rotativo_esnace_*.sql
2. Copia modelos, controlador, vistas, migraciones
3. php artisan migrate
4. Registra cargo $350 BUSAN
5. Verifica 95.63%

RESULTADO ESPERADO:
monto_asignado 10000
monto_ejecutado 9563.42
saldo_disponible 436.58
porcentaje_ejecutado 95.63
COM-20260925151104 5788.70
