<?php
session_start();
include 'config.php';
require 'lib/reportes.php';
$tipo = isset($_REQUEST['t']) ? $_REQUEST['t'] : 'excel';
$extension = '.xls';
$reportes = new reportes($datosConexionBD);
$reportes->periodo =$_REQUEST['periodo'];
$html = $reportes->empresasRubro();

require_once 'lib/dompdf/dompdf_config.inc.php';
$dompdf = new DOMPDF();
$dompdf->set_paper("letter", "landscape");
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("constancia.pdf");
?>