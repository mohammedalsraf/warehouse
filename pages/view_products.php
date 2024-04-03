<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
if ($_SESSION['role'][14] == 0) {
    header("Location: home.php");

}
$records_per_page = 10;
$page_to_fetch = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page_to_fetch - 1) * $records_per_page;



include('../includes/conn.php');
$sql = "SELECT * FROM products  LIMIT $offset, $records_per_page";

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
  <title>عرض المواد</title>
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
                <!-- <th scope="col">التسلسل</th> -->
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
              while ($row = mysqli_fetch_assoc($res)) {
                $t++;
                echo "<tr>";
                // echo "<td>" . $t . "</td>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['product_name'] . "</td>";

                // echo "<td>" ."<a class='btn btn-warning' href='thmam_basic.php?id=$row[id]'>تقرير ذمة  <a> ". "</td>";
                // echo "<td>" ."<a class='btn btn-primary' href='thmam_info.php?id=$row[id]'>تقرير ذمة تفصيلي <a> ". "</td>";
                echo "<td>" . "<a class='btn btn-primary' href='edit_product.php?id=$row[id]'>تعديل الماده<a> " . "</td>";
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
</body>

</html>
<?php
// Close the database connection
mysqli_close($conn);
?>