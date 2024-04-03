<?php
include('../includes/conn.php');

// Pagination setup

$vendor_id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : die("Vendor ID is not provided.");



// $records_per_page = 10;
// $page_to_fetch = isset($_GET['page']) ? $_GET['page'] : 1;
// $offset = ($page_to_fetch - 1) * $records_per_page;
$res='';
if(isset($_GET['start_date'])&&isset($_GET['end_date'])){
  $start_date=$_GET['start_date'];
  $end_date=$_GET['end_date'];
  $sql = "SELECT insert_basic.*, vendors.vendor_name
        FROM insert_basic 
        INNER JOIN vendors ON insert_basic.vendor_id=vendors.id 
        WHERE insert_basic.vendor_id=$vendor_id AND insert_date BETWEEN  '$start_date' AND  '$end_date'
        ORDER BY insert_date DESC
        ";

$res = mysqli_query($conn, $sql);

if (!$res) {
  die("فشل في جلب البيانات");
}

}


?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تقرير المورد</title>
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
         <!-- Add date range filter form -->
         <div class="row justify-content-center mb-4">
        <form method="GET" action="">
          <div class="row">
            <div class="col-md-2">
              <label for="start_date" class="form-label">من</label>
              <input type="date" class="form-control" name="start_date" id="start_date" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="col-md-2">
              <label for="end_date" class="form-label">الى</label>
              <input type="date" class="form-control" name="end_date" id="end_date" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="col-md-2 " style=" margin-top:32px;">
              <button type="submit" class="btn btn-primary">فلترة التقرير</button>
            </div>
          </div>
          <input type="hidden" name="id" value="<?php echo $vendor_id; ?>">
        </form>
      </div>
      <!-- End date range filter form -->
      <div class="row justify-content-center">
        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative;">
          <table class="table table-striped mb-0 table-bordered">
            <thead class="table-dark">
              <tr>
                
                <th scope="col">اسم المجهز</th>
                <th scope="col">رقم مستند الاستلام</th>
                <th scope="col">تاريخ مستند الاستلام</th>
                <th scope="col">رقم كتاب الاستلام</th>
                <th scope="col">تاريخ كتاب الاستلام</th>
                <th scope="col">الملاحضات</th>
                <th scope="col">المستخدم</th>
                <th scope="col">تاريخ الادخال</th>
                <th scope="col"></th>
                <th scope="col"></th>
               
              </tr>
            </thead>
            <tbody>
              <?php
              if($res!=''){
              
              while ($row = mysqli_fetch_assoc($res)) {
                echo "<tr>";
                echo "<td>" . $row['vendor_name'] . "</td>";
                echo "<td>" . $row['doc_number'] . "</td>";
                echo "<td>" . $row['doc_date'] . "</td>";
                echo "<td>" . $row['istlam_number'] . "</td>";
                echo "<td>" . $row['istlam_date'] . "</td>";
                echo "<td>" . $row['notes'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['insert_date'] . "</td>";
                echo "<td>" ."<a class='btn btn-primary' href='view_items.php?id=$row[id]'>عرض المواد<a> ". "</td>";
                echo "<td>" ."<a class='btn btn-danger' href='delete_insert.php?id=$row[id]'>حذف القيد<a> ". "</td>";
                echo "</tr>";
              }

              // Release the result set
              mysqli_free_result($res);
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
