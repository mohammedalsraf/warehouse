<?php
include('../includes/conn.php');

// Pagination setup
// $results_per_page = 2; // Number of results per page
// $current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page

if(isset($_POST['search']) &&$_POST['keyword']!="" ){
    $keyword = $_POST['keyword'];
    $sql = "SELECT insert_basic.*, vendors.vendor_name, SUM(insert_info.allPrice) as total
            FROM insert_basic
            INNER JOIN vendors ON insert_basic.vendor_id = vendors.id 
            INNER JOIN insert_info on insert_basic.id = insert_info.insert_id
            WHERE vendors.vendor_name LIKE '%$keyword%' 
            OR insert_basic.doc_number LIKE '%$keyword%' 
            OR insert_basic.istlam_number LIKE '%$keyword%' 
            OR insert_basic.rlegna LIKE '%$keyword%' 
            OR insert_basic.username LIKE '%$keyword%' 
            GROUP BY insert_basic.id
            ORDER BY insert_date DESC";
    
    $result = mysqli_query($conn, $sql);
    
    if (!$result) {
        die("فشل في جلب البيانات");
    }

    // // Count total number of results
    // $total_results = mysqli_num_rows($result);

    // // Calculate total number of pages
    // $total_pages = ceil($total_results / $results_per_page);

    // // Calculate the starting index for the results on the current page
    // $start_index = ($current_page - 1) * $results_per_page;

    // // Modify the query to include LIMIT and OFFSET
    // $sql .= " LIMIT $start_index, $results_per_page";

    // // Execute the modified query
    // $res = mysqli_query($conn, $sql);
} else {
  header('location: view_insert.php');

}
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>بحث في سندات الادخال</title>
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
                <th scope="col">اسم المجهز</th>
                <th scope="col">رقم مستند الاستلام</th>
                <th scope="col">تاريخ المستند </th>
                <th scope="col">رقم كتاب الاستلام</th>
                <th scope="col">تاريخ الكتاب </th>
                <th scope="col">الملاحضات</th>
                <th scope="col">رئيس اللجنة</th>
                <th scope="col">المستخدم</th>
                <th scope="col" >تاريخ الادخال</th>
                <th scope="col">مجموع </th>
                <th scope="col"></th>
                <th scope="col"></th>

              </tr>
            </thead>
            <tbody>
              <?php
              if(isset($_POST['search']) &&$_POST['keyword']!="" ){
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['vendor_name'] . "</td>";
                echo "<td>" . $row['doc_number'] . "</td>";
                echo "<td>" . $row['doc_date'] . "</td>";
                echo "<td>" . $row['istlam_number'] . "</td>";
                echo "<td>" . $row['istlam_date'] . "</td>";
                echo "<td>" . $row['notes'] . "</td>";
                echo "<td>" . $row['rlegna'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['insert_date'] . "</td>";
                echo "<td>" . $row['total'] . "</td>";
                echo "<td>" . "<a class='btn btn-primary' href='view_items.php?id=$row[id]'>عرض المواد<a> " . "</td>";
                echo "<td>" . "<a class='btn btn-danger' href='delete_insert.php?id=$row[id]'>حذف القيد<a> " . "</td>";
                echo "</tr>";
              }

              // Release the result set
              mysqli_free_result($result);
            }
              ?>
            </tbody>
          </table>
          <div class="row justify-content-center mt-1">
    <!-- Pagination controls -->
    <?php 
  //   if(isset($_POST['search'])){
  //      echo "<ul class='pagination'>";
      
  //     for ($page = 1; $page <= $total_pages; $page++) {
  //         echo "<li class='page-item ";
  //         echo ($page == $current_page) ? 'active' : '';
  //         echo "'><a class='page-link' href='?page=$page'>$page</a></li>";
  //     }
     
  // echo "</ul>";
      
  //   }
    
    
    
    
    
    ?>
   
</div>
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