<?php
include('../includes/conn.php');


if (isset($_POST['search']) && $_POST['keyword'] != "") {
    $keyword = $_POST['keyword'];
    $sql = "SELECT emp.*, dep_table.dep_name FROM emp INNER JOIN dep_table ON emp.dep_id=dep_table.id
    WHERE emp_name LIKE '%$keyword%' 

   ";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("فشل في جلب البيانات");
    }


} else {
    header('location:view_emp.php');
    exit();

}
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بحث في الموظفين</title>
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
                    <form method="POST" action="search_emp.php">
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
                                <th scope="col">معرف الموظف</th>
                                <th scope="col">اسم الموظف</th>
                                <th scope="col">القسم</th>

                                <th scope="col"></th>
                                <th scope="col"></th>
                                <!-- <th scope="col"></th>
                                <th scope="col"></th> -->
                                <!-- <th scope="col"></th> -->

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc( $result )) {


                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['emp_name'] . "</td>";
                                echo "<td>" . $row['dep_name'] . "</td>";

                                echo "<td>" . "<a class='btn btn-success' href='thmam_single_basic_emp.php?id=$row[id]&empName=$row[emp_name]'>تقرير ذمة مواد<a> " . "</td>";
                                echo "<td>" . "<a class='btn btn-primary' href='thmam_single_info_emp.php?id=$row[id]&empName=$row[emp_name]&dep=$row[dep_name]'>تقرير ذمة مواد تفصيلي <a> " . "</td>";
                                // echo "<td>" . "<a class='btn btn-warning' href='thmam_basic.php?id=$row[id]'> تقرير ذمة مخزن  <a> " . "</td>";
                                // echo "<td>" . "<a class='btn btn-primary' href='thmam_info.php?id=$row[id]'>تقرير ذمة مخزن تفصيلي <a> " . "</td>";
                                // echo "<td>" ."<a class='btn btn-danger' href='delete_vendor.php?id=$row[id]'>حذف المورد<a> ". "</td>";
                                echo "</tr>";
                            }

                            // Release the result set
                            mysqli_free_result( $result);
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