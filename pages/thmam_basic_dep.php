<?php

include('../includes/conn.php');
$id = $_GET['id'];
$dep_name=$_GET['dep_name'];
$sql = "SELECT thmam_single.id,  products.product_name, SUM(thmam_single.quantity) as total
FROM thmam_single
INNER JOIN products ON thmam_single.item_id = products.id
WHERE thmam_single.dep_id = $id
GROUP BY thmam_single.item_id
ORDER BY thmam_single.thmam_istlam_date;
";

$res = mysqli_query($conn, $sql);

if (!$res) {
  die("فشل في جلب البيانات");
}

$sql="SELECT
COUNT(*) AS record_count
FROM
(
  SELECT thmam_single.id,  products.product_name, SUM(thmam_single.quantity) as total
FROM thmam_single
INNER JOIN products ON thmam_single.item_id = products.id
WHERE thmam_single.dep_id = $id
GROUP BY thmam_single.item_id
ORDER BY thmam_single.thmam_istlam_date) AS subquery;";
$ress = mysqli_query($conn, $sql);
if (!$ress) {
  die("فشل في جلب البيانات");
}
$row=mysqli_fetch_assoc($ress);
$count=$row['record_count'];

?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تقرير ذمة قسم او دائرة</title>
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
    <div class="container mt-5">
    <div class="row mb-3">
                <div class="col-md-3 offset-md-3">
                
                        <div class="input-group">
                      
                          <?php
                          echo "  <a class='btn btn-primary me-1   btn-border-circular' href='report_thmam_dep_print.php?id=$id & dep_name=$dep_name'
                          >طباعة التقرير</a>"
                          
                          
                          ?>
                            <a  class="btn btn-warning me-1   btn-border-circular" href="view_dep.php"
                               >رجوع</a>
                        </div>
              
                </div>
            </div>
      <div class="row justify-content-between mb-1 bg-dark text-white  " style="  margin-right: 1px; margin-left: 1px">
        <div class="col-md-12">
          <div class="pt-1">
            <h2 class="text-center">تقرير ذمة قسم او دائرة</h2>


          </div>
        </div>
        <div class="col-6">
          <?php
          // Display employee name and number of items here
          echo "<h5> اسم الدائرة :   <span class='text-warning'>" .$dep_name. "</span></h5>";
          echo "<h5>  عدد المواد :   <span class='text-warning'> $count </span></h5>";
    
          ?>
        </div>
        <div class="col-6">
          <?php
          // Display employee name and number of items here
          echo "<h5 style='text-align: left;'>التاريخ: " . date('Y-m-d') . "</h5>";
          ?>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative;">
          <table class="table table-striped mb-0 table-bordered">
            <thead class="table-dark">
              <tr>

                <th scope="col">اسم المادة</th>
                <th scope="col">الكمية</th>




                <!-- <th scope="col"></th> -->

              </tr>
            </thead>
            <tbody>
              <?php
              while ($row = mysqli_fetch_assoc($res)) {
                echo "<tr>";

                echo "<td>" . $row['product_name'] . "</td>";
                echo "<td>" . $row['total'] . "</td>";



                // echo "<td>" ."<a class='btn btn-danger' href='delete_vendor.php?id=$row[id]'>حذف المورد<a> ". "</td>";
                echo "</tr>";
              }

              // Release the result set
              mysqli_free_result($res);
              ?>
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