<?php
include('../includes/conn.php');
$id=$_GET['id'];
$sql="DELETE FROM insert_basic WHERE id=$id";
$res=mysqli_query($conn,$sql);
if(!$res){
    die("Fail DELET from IB");
}

$sqll="DELETE FROM insert_info WHERE insert_id=$id";
$res=mysqli_query($conn,$sqll);
if(!$res){
    die("Fail DELET from II");
}
 header('location: view_insert.php');












?>