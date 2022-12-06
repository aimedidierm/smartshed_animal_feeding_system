<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
require 'php-includes/connect.php';

if(isset($_POST['distance1'])){
    $distance1=150-($_POST['distance1']*10);
    $distance2=100-($_POST['distance2']*10);
    $sql ="INSERT INTO lever (tank1,tank2) VALUES (?,?)";
    $stm = $db->prepare($sql);
    $stm->execute(array($distance1,$distance2));
}
?>