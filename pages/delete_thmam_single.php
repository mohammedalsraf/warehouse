<?php 
include('../includes/conn.php');
$id=$_GET['id'];
$sql="DELETE FROM thmam_single WHERE id=$id";
$res=mysqli_query($conn,$sql);
if(!$res){
    die("Fail DELET from IB");
}
header("location: view_thmam_single.php")




?>