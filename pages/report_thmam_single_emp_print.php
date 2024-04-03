<?php

include('../includes/conn.php');
$id = $_GET['id'];
$empName=$_GET['empName'];
$sql = "SELECT thmam_single.id, emp.emp_name, products.product_name, SUM(thmam_single.quantity) as total
FROM thmam_single
INNER JOIN emp ON thmam_single.emp_id = emp.id
INNER JOIN products ON thmam_single.item_id = products.id
WHERE thmam_single.emp_id = $id
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
    SELECT
        thmam_single.id,
        emp.emp_name,
        products.product_name,
        SUM(thmam_single.quantity) AS total
    FROM
        thmam_single
    INNER JOIN
        emp ON thmam_single.emp_id = emp.id
    INNER JOIN
        products ON thmam_single.item_id = products.id
    WHERE
        thmam_single.emp_id = $id
    GROUP BY
        thmam_single.item_id, emp.emp_name, products.product_name
    ORDER BY
        thmam_single.thmam_istlam_date
) AS subquery;";
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
  <title>تقرير ذمة موظف</title>
  <link href="bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="select22.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="stylem.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .table-container {
            margin-top: 20px;
        }
        @media print {
            @page {
                size: A4 portrait; /* Set page size to A4 and orientation to landscape */
                margin: 0; /* Reset default margin */
               
            }
            

            body {
                margin: 1.5cm; /* Set margin for content */
                font-family: 'Cairo', sans-serif;
               
            }
        }
    </style>
</head>

<body class="insertbg" onload="window.print()">


  <section class="intro">
    <div class="container-fluid">

      <div class="row justify-content-between mb-1 bg-dark   " style="  margin-right: 1px; margin-left: 1px">
        <div class="col-md-12">
          <div class="pt-1">
            <h2 class="text-center">تقرير ذمة الموظف</h2>


          </div>
        </div>
        <div class="col-6">
          <?php
          // Display employee name and number of items here
          echo "<h5> اسم الموظف :   <span class='text'>" .$empName . "</span></h5>";
          echo "<h5>  عدد المواد :   <span class='text'> $count </span></h5>";
    
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
            <thead class="">
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

  <script>
        // Redirect user to a specific page after printing or canceling print
        window.onafterprint = function() {
            window.location.href = "view_emp.php"; // Change "specific_page.php" to your desired page
        };
    </script>
</body>

</html>
<?php
// Close the database connection
mysqli_close($conn);
?>