<?php
header('Access-Control-Allow-Origin: *');
include_once "../__root__.php";
include_once root."/Services/ycpServices.php";

$ycp = new ycpServices();

echo $ycp->createToken();
