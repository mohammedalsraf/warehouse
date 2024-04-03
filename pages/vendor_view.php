<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
if ($_SESSION['role'][6] == 0) {
    header("Location: home.php");

}
include('../includes/conn.php');
$sql = "SELECT * FROM vendors";

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
  <title>عرض المجهزين</title>
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
    <div class="row mb-3">
                <div class="col-md-3 offset-md-3">
                    <form method="POST" action="search_vendors.php">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="ابحث" name="keyword">
                            <button type="submit" class="btn btn-warning me-1   btn-border-circular"
                                name="search">البحث</button>
                        </div>
                    </form>
                </div>
            </div>
      <div class="row justify-content-center">
        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative;">
          <table class="table table-striped mb-0 table-bordered">
            <thead class="table-dark">
              <tr>
                <th scope="col">معرف المجهز</th>
                <th scope="col">اسم المجهز</th>
                <th scope="col">رقم الهاتف</th>
            
                <th scope="col"></th>
                <th scope="col"></th>
                <!-- <th scope="col"></th> -->
              
              </tr>
            </thead>
            <tbody>
              <?php
              while ($row = mysqli_fetch_assoc($res)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['vendor_name'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
    
                echo "<td>" ."<a class='btn btn-primary' href='edit_vendor.php?id=$row[id]'>تعديل <a> ". "</td>";
                echo "<td>" ."<a class='btn btn-primary' href='vendor_report.php?id=$row[id]'>تقرير المجهز<a> ". "</td>";
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
