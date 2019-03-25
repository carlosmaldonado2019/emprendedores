<?php
/**
 * Created by PhpStorm.
 * User: CMaldonado
 * Date: 25/03/2019
 * Time: 02:07 PM
 */

include '../config.php';
require '../lib/periodos.php';

$periodos = new periodos($datosConexionBD);
$periodos->periodo =$_POST['periodo'];
echo $periodos->altaPeriodo();