<?php
include('../includes/conn.php');


if (isset($_POST['search']) && $_POST['keyword'] != "") {
    $keyword = $_POST['keyword'];
    $sql = "SELECT takeout_basic.*, emp.emp_name,dep_table.dep_name,SUM(takeout_info.allPrice) as total
    FROM takeout_basic
    INNER JOIN emp ON takeout_basic.emp_id=emp.id 
    INNER JOIN takeout_info on takeout_basic.id=takeout_info.takeout_id
    INNER JOIN dep_table ON takeout_basic.dep_id=dep_table.id 
    WHERE emp.emp_name LIKE '%$keyword%' 
            OR dep_table.dep_name LIKE '%$keyword%' 
            OR takeout_basic.taghez_number LIKE '%$keyword%' 
            OR takeout_basic.kitab_number LIKE '%$keyword%' 
            OR takeout_basic.username LIKE '%$keyword%' 
            OR takeout_basic.notes LIKE '%$keyword%' 

    GROUP BY takeout_basic.id
    ORDER BY takeout_date DESC";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("فشل في جلب البيانات");
    }


} else {
    header('location: view_takeout.php');

}
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بحث قيود الاخراج</title>
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
                    <form method="POST" action="">
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
                            if (isset($_POST['search']) && $_POST['keyword'] != "") {
                                while ($row = mysqli_fetch_assoc($result)) {
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
                                    echo "<td>" . "<a class='btn btn-danger' href='delete_takeout.php?id=$row[id]'>حذف القيد<a> " . "</td>";
                                    echo "</tr>";
                                }

                                // Release the result set
                                mysqli_free_result($result);
                            }
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