<?php
include('../includes/conn.php');
$id=$_GET['id'];
$sql = "SELECT takeout_info.*, products.product_name 
FROM takeout_info 
JOIN products ON takeout_info.item_id = products.id 
WHERE takeout_info.takeout_id = $id;";
$res = mysqli_query($conn, $sql);

if (!$res) {
  die("فشل في جلب البيانات");
}

?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>عرض المواد</title>
  <link href="bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="select22.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="stylem.css">
</head>

<body class="insertbg">
  <?php
  include("../includes/menu.php")
  ?>
  
  <section class="intro">
    <div class="container mt-5 ">
      <div class="row justify-content-center">
        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative;">
        <a class="btn btn-lg btn-primary my-2" href="view_takeout.php">رجوع</a>
          <table class="table table-striped mb-0 table-bordered">
            <thead class="table-dark">
              <tr>
                <th scope="col">اسم الماده</th>
                <th scope="col">الكمية</th>
                <th scope="col">سعر المفرد</th>
                <th scope="col">السعر الاجمالي</th>
                <th scope="col">نوع المادة</th>
              
                
              </tr>
            </thead>
            <tbody>
              <?php
              while ($row = mysqli_fetch_assoc($res)) {
                echo "<tr>";
                echo "<td>" . $row['product_name'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . $row['singlePrice'] . "</td>";
                echo "<td>" . $row['allPrice'] . "</td>";
                echo "<td>" . $row['type'] . "</td>";
               
                // echo "<td>" ."<a class='btn btn-primary' href='view_items.php?id=$row[id]'>عرض المواد<a> ". "</td>";
                echo "</tr>";
                
                
              }

              // Release the result set
            
              mysqli_free_result($res);
              ?>
              <?php include('functions.php') ?>
                <tr class="table-danger">
              <td colspan="3"></td>
              <td> <h4>المجموع الاجمالي :  <?php echo getSumTakeout('takeout_info','allPrice',$id) ?></h4></td>
              <td></td>
            </tr>
         
              
            </tbody>
            
          </table>
        
          
        </div>
        

  

      </div>
    </div>
  </section>
</body>

</html>
<?php
// Close the database connection
mysqli_close($conn);
?>
