<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
if ($_SESSION['role'][3] == 0) {
    header("Location: home.php");

}
include('../includes/conn.php');

// Pagination setup
$records_per_page = 10;
$page_to_fetch = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page_to_fetch - 1) * $records_per_page;

$sql = "SELECT takeout_basic.*, emp.emp_name,dep_table.dep_name,SUM(takeout_info.allPrice) as total
        FROM takeout_basic
        INNER JOIN emp ON takeout_basic.emp_id=emp.id 
        INNER JOIN takeout_info on takeout_basic.id=takeout_info.takeout_id
        INNER JOIN dep_table ON takeout_basic.dep_id=dep_table.id 
        GROUP BY takeout_basic.id
        ORDER BY takeout_date DESC
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
    <title>عرض سندات الاخراج</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="stylem.css">


</head>

<body class="insertbg">
    <?php
    include("../includes/menu.php")
        ?>
    <section class="intro">
        <div class="container mt-5 ">
            <div class="row mb-3">
                <div class="col-md-3 offset-md-3">
                    <form method="POST" action="search_takeout.php">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="ابحث" name="keyword">
                            <button type="submit" class="btn btn-warning me-1   btn-border-circular"
                                name="search">البحث</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true"
                    style="position: relative;">
                    <table class="table table-striped mb-0 table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">اسم المستلم</th>
                                <th scope="col">الدائرة المستلمة</th>
                                <th scope="col">رقم مستند التجهيز</th>
                                <th scope="col">تاريخ المستند </th>
                                <th scope="col">رقم كتاب التجهيز</th>
                                <th scope="col">تاريخ الكتاب </th>
                                <th scope="col">الملاحضات</th>
                                <th scope="col">المستخدم</th>
                                <th scope="col">تاريخ الاخراج</th>
                                <th scope="col">مجموع </th>
                                <th scope="col"></th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($res)) {
                                echo "<tr>";
                                echo "<td>" . $row['emp_name'] . "</td>";
                                echo "<td>" . $row['dep_name'] . "</td>";
                                echo "<td>" . $row['taghez_number'] . "</td>";
                                echo "<td>" . $row['taghez_date'] . "</td>";
                                echo "<td>" . $row['kitab_number'] . "</td>";
                                echo "<td>" . $row['kitab_date'] . "</td>";
                                echo "<td>" . $row['notes'] . "</td>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['takeout_date'] . "</td>";
                                echo "<td>" . $row['total'] . "</td>";
                                echo "<td>" . "<a class='btn btn-primary' href='view_takeout_items.php?id=$row[id]'>عرض المواد<a> " . "</td>";
                                echo "<td>" . "<a class='btn btn-danger' href='delete_takeout.php?id=$row[id]' onclick='return confirmDelete();'>حذف القيد<a> " . "</td>";
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
                            $total_records_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM takeout_basic");
                            $total_records = mysqli_fetch_assoc($total_records_query)['total'];
                            $total_pages = ceil($total_records / $records_per_page);

                            // Define how many pages to display at a time
                            $num_pages_to_show = 5;

                            // Calculate starting page based on current page
                            $start_page = max(1, $page_to_fetch - floor($num_pages_to_show / 2));

                            // Calculate ending page based on starting page
                            $end_page = min($start_page + $num_pages_to_show - 1, $total_pages);

                            for ($i = $start_page; $i <= $end_page; $i++) {
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
 
    <script scr="script.js">
function confirmDelete() {
    return confirm('هل أنت متأكد أنك تريد حذف هذا القيد؟');
}
</script>
</body>

</html>
<?php
// Close the database connection
mysqli_close($conn);
?>