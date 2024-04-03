<?php

include('../includes/conn.php');
$id = $_GET['id'];
$empName = $_GET['empName'];
$dep=$_GET['dep'];
$sql = "SELECT thmam_single.*, emp.emp_name, products.product_name,dep_table.dep_name
FROM thmam_single
INNER JOIN emp ON thmam_single.emp_id = emp.id
INNER JOIN products ON thmam_single.item_id = products.id
INNER JOIN dep_table ON thmam_single.dep_id=dep_table.id
WHERE thmam_single.emp_id = $id
ORDER BY thmam_single.thmam_istlam_date;
";

$res = mysqli_query($conn, $sql);

if (!$res) {
    die("فشل في جلب البيانات");
}

$sql = "SELECT
COUNT(*) AS record_count
FROM
(
    SELECT thmam_single.*, emp.emp_name, products.product_name,dep_table.dep_name
FROM thmam_single
INNER JOIN emp ON thmam_single.emp_id = emp.id
INNER JOIN products ON thmam_single.item_id = products.id
INNER JOIN dep_table ON thmam_single.dep_id=dep_table.id
WHERE thmam_single.emp_id = $id
ORDER BY thmam_single.thmam_istlam_date
) AS subquery;";
$ress = mysqli_query($conn, $sql);
if (!$ress) {
    die("فشل في جلب البيانات");
}
$row = mysqli_fetch_assoc($ress);
$count = $row['record_count'];

?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقرير ذمة موظف تفصيلي</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="select22.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="stylem.css">
</head>

<body class="insertbg" >
    <?php
    include("../includes/menu.php")
        ?>

    <section class="intro">
        <div class="container mt-5">
            
        <div class="row mb-3">
                <div class="col-md-3 offset-md-3">
                
                        <div class="input-group">
                      
                          <?php
                          echo "  <a class='btn btn-primary me-1   btn-border-circular' href='report_thmam_single_info_print.php?id=$id & empName=$empName & dep=$dep'
                          >طباعة التقرير</a>"
                          
                          
                          ?>
                            <a  class="btn btn-warning me-1   btn-border-circular" href="view_emp.php"
                               >رجوع</a>
                        </div>
              
                </div>
            </div>
            <div class="row justify-content-between mb-1 bg-dark text-white  "
                style="  margin-right: 1px; margin-left: 1px">
                <div class="col-md-12">
                    <div class="pt-1">
                        <h2 class="text-center">تقرير ذمة الموظف</h2>


                    </div>
                </div>
                <div class="col-6">
                    <?php
                    // Display employee name and number of items here
                    echo "<h5> اسم الموظف :   <span class='text-warning'>" . $empName . "</span></h5>";
                    echo "<h5>   القسم :   <span class='text-warning'> $dep </span></h5>";
                    echo "<h5>   عدد القيود  :   <span class='text-warning'> $count </span></h5>";

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
                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true"
                    style="position: relative;">
                    <table class="table table-striped mb-0 table-bordered">
                        <thead class="table-dark">
                            <tr>

                                <th scope="col">رقم المستند</th>
                                <th scope="col">تاريخ المستند</th>
                                <th scope="col">الملاحضات</th>
                                <th scope="col">المستخدم</th>
                                <th scope="col">اسم المادة</th>
                                <th scope="col">رقم الجهاز</th>
                                <th scope="col"> الكمية</th>
                                <th scope="col">سعر المفرد</th>
                                <th scope="col">الاجمالي</th>
                                <th scope="col">نوع الماده</th>
                                <th scope="col">تاريخ الاستلام</th>
                          




                                <!-- <th scope="col"></th> -->

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($res)) {
                                echo "<tr>";

                                echo "<td>" . $row['taghez_number'] . "</td>";
                                echo "<td>" . $row['taghez_date'] . "</td>";
                                echo "<td>" . $row['notes'] . "</td>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['product_name'] . "</td>";
                                echo "<td>" . $row['sn'] . "</td>";
                                echo "<td>" . $row['quantity'] . "</td>";
                                echo "<td>" . $row['singlePrice'] . "</td>";
                                echo "<td>" . $row['allPrice'] . "</td>";
                                echo "<td>" . $row['type'] . "</td>";
                                echo "<td>" . $row['thmam_istlam_date'] . "</td>";



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