<?php
include('../includes/conn.php');
$takeout_id=$_GET['id'];
$sql = "SELECT takeout_basic.*,emp.emp_name,takeout_info.*,products.product_name  FROM takeout_basic
INNER JOIN emp ON takeout_basic.emp_id=emp.id 
INNER JOIN takeout_info on takeout_basic.id=takeout_info.takeout_id
INNER JOIN products ON takeout_info.item_id=products.id
WHERE takeout_basic.emp_id=$takeout_id
";

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
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../style.css">
</head>

<body class="insertbg">
  <?php
  include("../includes/menu.php")
  ?>
  <section class="intro">
    <div class="container mt-5 ">
      <div class="row justify-content-center">
        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative;">
          <table class="table table-striped mb-0 table-bordered">
            <thead class="table-dark">
              <tr>
                <th scope="col">اسم المادة</th>
                <th scope="col">رقم الجهاز</th>
                <th scope="col">الكمية</th>
                <th scope="col">النوع</th>
                <th scope="col">السعر الكلي</th>
                <th scope="col">رقم مستند التجهيز</th>
                <th scope="col">تاريخ مستند التجهيز</th>
                <th scope="col">رقم كتاب التجهيز</th>
                <th scope="col">تاريخ كتاب التجهيز</th>
                <th scope="col">تاريخ الاخراج</th>
            
                
                <!-- <th scope="col"></th> -->
              
              </tr>
            </thead>
            <tbody>
              <?php
              while ($row = mysqli_fetch_assoc($res)) {
                echo "<tr>";
                echo "<td>" . $row['product_name'] . "</td>";
                echo "<td>" . $row['sn'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . $row['type'] . "</td>";
                echo "<td>" . $row['allPrice'] . "</td>";
                echo "<td>" . $row['taghez_number'] . "</td>";
                echo "<td>" . $row['taghez_date'] . "</td>";
                echo "<td>" . $row['kitab_number'] . "</td>";
                echo "<td>" . $row['kitab_date'] . "</td>";
                echo "<td>" . $row['takeout_date'] . "</td>";
    
             
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
