<?php
include('../includes/conn.php');


if (isset($_POST['search']) && $_POST['keyword'] != "") {
    $keyword = $_POST['keyword'];
    $sql = "SELECT * FROM products 
    WHERE product_name LIKE '%$keyword%' 

   ";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("فشل في جلب البيانات");
    }


} else {
    header('location: view_products.php');

}
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بحث المواد</title>
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
                    <form method="POST" action="search_product.php">
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
          <?php
          if (isset($_SESSION['edtMsg'])) {
            $edtMsg = $_SESSION['edtMsg'];
          }

          if (!empty($edtMsg)) {

            echo "<div class='alert alert-success mt-2' role='alert'>
                                $edtMsg
                                  </div>";
            unset($_SESSION['edtMsg']);
          }


          ?>
          <table class="table table-striped mb-0 table-bordered">
            <thead class="table-dark">
              <tr>
                <th scope="col">التسلسل</th>
                <th scope="col">معرف المادة</th>
                <th scope="col">اسم المادة</th>

                <th scope="col"></th>
                <!-- <th scope="col"></th> -->
                <!-- <th scope="col"></th> -->

              </tr>
            </thead>
            <tbody>
              <?php
              $t = 0;
              while ($row = mysqli_fetch_assoc($result)) {
                $t++;
                echo "<tr>";
                echo "<td>" . $t . "</td>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['product_name'] . "</td>";

                // echo "<td>" ."<a class='btn btn-warning' href='thmam_basic.php?id=$row[id]'>تقرير ذمة  <a> ". "</td>";
                // echo "<td>" ."<a class='btn btn-primary' href='thmam_info.php?id=$row[id]'>تقرير ذمة تفصيلي <a> ". "</td>";
                echo "<td>" . "<a class='btn btn-primary' href='edit_product.php?id=$row[id]'>تعديل الماده<a> " . "</td>";
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