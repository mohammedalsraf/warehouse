<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
if ($_SESSION['role'][4] == 0) {
    header("Location: home.php");

}
include('../includes/conn.php');

// Pagination setup
$records_per_page = 15;
$page_to_fetch = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page_to_fetch - 1) * $records_per_page;

$sql = "SELECT 
p.product_name,
COALESCE(i.insertt, 0) AS insertt,
COALESCE(t.takeout, 0) AS takeout,

(COALESCE(i.insertt, 0) - COALESCE(t.takeout, 0)) AS total
FROM 
products p
LEFT JOIN (
SELECT 
    item_id,
    SUM(quantity) AS takeout
FROM 
    takeout_info
GROUP BY 
    item_id
) t ON p.id = t.item_id
LEFT JOIN (
SELECT 
    item_id,
    SUM(quantity) AS insertt
FROM 
    insert_info
GROUP BY 
    item_id
) i ON p.id = i.item_id

 LIMIT $offset, $records_per_page";

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
    <title>جرد المخزن</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap.bundle.min.js"></script>
  
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="stylem.css">
    <style>
      
</style>
    </style>
</head>

<body class="insertbg">
    <?php
    include("../includes/menu.php")
        ?>
    <section class="intro">
        <div class="container mt-5 ">
            <div class="row mb-3">
                <div class="col-md-3 offset-md-3">
                    <form method="POST" action="search_quantity.php">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="ابحث" name="keyword">
                            <button type="submit" class="btn btn-warning me-1   btn-border-circular"
                                name="search">البحث</button>
                            <a type="submit" class="btn btn-primary me-1   btn-border-circular" href="report_quantity_print.php"
                                name="search">طباعة التقرير</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true"
                    style="position: relative;">
                    <table class="table table-striped mb-0 table-bordered" >
                        <thead class="table-dark">
                            <tr>
                                <!-- <th scope="col" style="width:10px">التسلسل</th> -->
                                <th scope="col">اسم المادة</th>
                                <th scope="col" style="width:110px">اجمالي الداخل</th>
                                <th scope="col"  style="width:110px">اجمالي الخارج</th>
                                <th scope="col"  style="width:110px">المتبقي</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $taslsl = 0;

                            while ($row = mysqli_fetch_assoc($res)) {
                                $taslsl++;
                                if (is_null($row['insertt'])) {
                                    $row['insertt'] = 0;
                                }
                                if (is_null($row['takeout'])) {
                                    $row['takeout'] = 0;
                                }
                                if (is_null($row['total'])) {
                                    $row['total'] = $row['insertt'] - $row['takeout'];
                                }

                                echo "<tr>";
                                // echo "<td>" . $taslsl . "</td>";
                                echo "<td>" . $row['product_name'] . "</td>";
                                echo "<td>" . $row['insertt'] . "</td>";
                                echo "<td>" . $row['takeout'] . "</td>";
                                echo "<td>" . $row['total'] . "</td>";

                                echo "</tr>";
                            }

                            // Release the result set
                            mysqli_free_result($res);
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php
                            $total_records_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM products");
                            $total_records = mysqli_fetch_assoc($total_records_query)['total'];
                            $total_pages = ceil($total_records / $records_per_page);

                            for ($i = 1; $i <= $total_pages; $i++) {
                                $active_class = ($i == $page_to_fetch) ? 'active' : '';
                                echo '<li class="page-item ' . $active_class . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
                <!-- End Pagination -->

            </div>
        </div>
    </section>
</body>

</html>
<?php
// Close the database connection
mysqli_close($conn);
?>