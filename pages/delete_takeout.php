<?php
include('../includes/conn.php');
$id=$_GET['id'];
$sql="DELETE FROM takeout_basic WHERE id=$id";
$res=mysqli_query($conn,$sql);
if(!$res){
    die("Fail DELET from TB");
}

$sqll="DELETE FROM takeout_info WHERE takeout_id=$id";
$res=mysqli_query($conn,$sqll);
if(!$res){
    die("Fail DELET from TI");
}
 header('location: view_takeout.php');












?>