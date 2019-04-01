<?php
session_start(); 
session_destroy(); 
header("LOCATION: http://emprendedores.fcauabc.com");
exit();
?>