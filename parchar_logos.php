<?php
$base = __DIR__;
if(!is_dir($base.'/resources/views')) $base = '/opt/homebrew/var/www/fondo-rotativo-esnace';
$bladePath = $base.'/resources/views/comisiones/mini_liquidacion.blade.php';
foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($base.'/resources/views')) as $f){
    if($f->getFilename()=='mini_liquidacion.blade.php'){ $bladePath = $f->getPathname(); break; }
}
$bak = $bladePath.'.bak2_'.date('Ymd_His'); copy($bladePath, $bak);
$content = file_get_contents($bak);
$newHeader = '
@php
$logoArmadaPath = public_path(\'images/logo_armada.png\');
$logoCoopnaPath = public_path(\'images/logo_coopna.png\');
$logoArmadaB64 = file_exists($logoArmadaPath) ? \'data:image/png;base64,\'.base64_encode(file_get_contents($logoArmadaPath)) : \'\';
$logoCoopnaB64 = file_exists($logoCoopnaPath) ? \'data:image/png;base64,\'.base64_encode(file_get_contents($logoCoopnaPath)) : \'\';
@endphp
<div class="header" style="border:2px solid #000; padding:5px;">
<table width="100%" style="border:none; border-collapse:collapse;">
<tr>
<td width="12%" style="border:none; text-align:left; vertical-align:top;">
@if($logoArmadaB64)<img src="{{ $logoArmadaB64 }}" style="width:70px; height:70px;">@endif
</td>
<td width="76%" style="border:none; text-align:center; vertical-align:middle;">
<h1 style="font-size:12px; margin:0;">ARMADA DEL ECUADOR - COMANDO DE OPERACIONES NAVALES</h1>
<h1 style="font-size:11px; margin:2px 0;">FONDO ROTATIVO PASAJES AÉREOS - KARDEX POR COMISIÓN - MINI LIQUIDACIÓN</h1>
<h2 style="font-size:9px; margin:2px 0;">Comisión: {{ $comision->codigo }} | Destino: {{ $comision->destino }} | Tipo: {{ $comision->tipo }} | Total REAL: ${{ number_format($totalComision,2) }} único | Cuenta: 3-00167809-0 | Saldo Final: $431.55</h2>
</td>
<td width="12%" style="border:none; text-align:right; vertical-align:top;">
@if($logoCoopnaB64)<img src="{{ $logoCoopnaB64 }}" style="width:70px; height:70px;">@endif
</td>
</tr>
</table>
</div>
';
$content = preg_replace('/@php.*?@endphp\s*<div class="header">.*?<\/div>\s*<\/div>/s', $newHeader, $content);
if(strpos($content, 'logoArmadaB64')===false){
    $content = file_get_contents($bak);
    $content = str_replace('<body>', "<body>\n".$newHeader, $content);
    $content = preg_replace('/<div class="header">.*?<\/div>\s*<\/div>/s', '', $content, 1);
}
file_put_contents($bladePath, $content);
echo "Header corregido\n";
// Boton a PDF
foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($base.'/resources/views')) as $f){
    if(strpos($f->getFilename(), '.blade.php')!==false){
        $c = file_get_contents($f->getPathname());
        if(strpos($c, 'mini-liquidacion')!==false && strpos($c, '/mini-liquidacion"')!==false){
            $bakV = $f->getPathname().'.bak_boton'; copy($f->getPathname(), $bakV);
            $cNew = str_replace('/mini-liquidacion"', '/mini-liquidacion/pdf"', $c);
            file_put_contents($f->getPathname(), $cNew);
            echo "Boton corregido en ".$f->getPathname()."\n";
        }
    }
}