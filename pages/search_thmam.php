<?php
include('../includes/conn.php');


if (isset($_POST['search']) && $_POST['keyword'] != "") {
    $keyword = $_POST['keyword'];
    $sql = "SELECT thmam_single.*,emp.emp_name ,dep_table.dep_name,products.product_name FROM thmam_single 
    INNER JOIN emp ON thmam_single.emp_id=emp.id
    INNER JOIN dep_table ON thmam_single.dep_id=dep_table.id
    INNER JOIN products ON thmam_single.item_id=products.id
    WHERE emp.emp_name LIKE '%$keyword%' 
            OR dep_table.dep_name LIKE '%$keyword%' 
            OR thmam_single.taghez_number LIKE '%$keyword%' 
            OR thmam_single.notes LIKE '%$keyword%' 
            OR thmam_single.username LIKE '%$keyword%' 
            OR products.product_name LIKE '%$keyword%' 
            OR thmam_single.sn LIKE '%$keyword%' 
            OR thmam_single.type LIKE '%$keyword%' 
            ORDER BY thmam_single.thmam_istlam_date DESC

  ";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("فشل في جلب البيانات");
    }


} else {
    header('location: view_thmam_single.php');
    exit();

}
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بحث في الذمم</title>
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
    <form method="POST" action="search_thmam.php">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="ابحث" name="keyword">
        <button type="submit" class="btn btn-warning me-1   btn-border-circular" name="search">البحث</button>
      </div>
    </form>
  </div>
</div>
      <div class="row justify-content-center">
        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative;">
          <table class="table table-striped mb-0 table-bordered">
            <thead class="table-dark">
              <tr>
                <th scope="col">اسم المستلم</th>
                <th scope="col">الدائرة المستلمة</th>
                <th scope="col">رقم المستند </th>
                <th scope="col">تاريخ المستند </th>
                <th scope="col">الملاحضات</th>
                <th scope="col">المستخدم</th>
                <th scope="col">المادة</th>
                <th scope="col">رقم الجهاز</th>
                <th scope="col">الكمية</th>
                <th scope="col">سعر المفرد</th>
                <th scope="col">الاجمالي</th>
                <th scope="col">نوع المادة</th>
                <th scope="col">تاريخ الاستلام</th>
                <th scope="col"></th>
                <th scope="col"></th>

              </tr>
            </thead>
            <tbody>
              <?php
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['emp_name'] . "</td>";
                echo "<td>" . $row['dep_name'] . "</td>";
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
                echo "<td>" . "<a class='btn btn-primary' href='edit_thmam_single.php?id=$row[id]'>تعديل القيد<a> " . "</td>";
                echo "<td>" . "<a class='btn btn-danger' href='delete_thmam_single.php?id=$row[id]'>حذف القيد<a> " . "</td>";
                echo "</tr>";
              }

              // Release the result set
              mysqli_free_result($result);
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