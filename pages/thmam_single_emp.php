<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
if ($_SESSION['role'][8] == 0) {
    header("Location: home.php");

}

include('../includes/conn.php');
include('functions.php');

////////////////////////////////////////////////////////////////////////////////////////////////
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submit'])) {
        if (
            $_POST['emp_id'] != "" && $_POST['dep_id'] != "" && $_POST['taghez_number'] != ""
            && $_POST['quantity'][0] != "" && $_POST['singlePrice'][0] != "" && $_POST['allPrice'][0] != ""

        ) {

            $emp_id = $_POST['emp_id'];
            $dep_id = $_POST['dep_id'];
            $taghez_number = $_POST['taghez_number'];
            $taghez_date = $_POST['taghez_date'];
            $notes = $_POST['notes'];
            $username = $_POST['username'];
            $item_id = $_POST['item_id'];
            $quantity = $_POST['quantity'];
            $singlePrice = $_POST['singlePrice'];
            $allPrice = $_POST['allPrice'];
            $type = $_POST['type'];
            $sn = $_POST['sn'];

            $sqli = "INSERT INTO thmam_single (emp_id,dep_id,taghez_number,taghez_date,notes,username,item_id,quantity,singlePrice,allPrice,type,sn) VALUES 
        ('$emp_id','$dep_id','$taghez_number','$taghez_date','$notes','$username','$item_id','$quantity','$singlePrice','$allPrice','$type','$sn')";
            $res = mysqli_query($conn, $sqli);
            if ($res) {
                // Retrieve the last inserted ID
                // $last_inserted_id = mysqli_insert_id($conn);

                // // Insert data into the second table (items and quantities)
                // $items = $_POST['item'];
                // $quantities = $_POST['quantity'];
                // $singlePrice = $_POST['singlePrice'];
                // $allPrice = $_POST['allPrice'];
                // $type = $_POST['type'];
                // $sn = $_POST['sn'];

                // for ($i = 0; $i < count($items); $i++) {
                //     $item_id = $items[$i];
                //     $quantity = $quantities[$i];
                //     $singlePricee = $singlePrice[$i];
                //     $allPricee = $allPrice[$i];
                //     $typee = $type[$i];
                //     $sn = $sn[$i];

                //     $sql = "INSERT INTO takeout_info (takeout_id,item_id,quantity,singlePrice,allPrice,type,sn) VALUES
                //  ('$last_inserted_id','$item_id','$quantity','$singlePricee','$allPricee','$typee','$sn')";
                //     mysqli_query($conn, $sql);
                // }
                $success = "تم انجاز قيد الذمة بنجاح";

                // Close the database connection
                $conn->close();
            }
        } else {
            $error = "الحقول المشار لها ب (*) مطلوبة تاكد من ملئها";
        }

    }
}
///////////////////////////////////////////////////////////////////////////////////////////////
?>
<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قيد ذمة</title>
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
    <section>
        <div class="container mt-3 ">
        <div class="card shadow">
            <div class="card-header">
                <h3>انشاء قيد ذمة  </h3>
            </div>
            <div class="card-body">
            <form class="row g-3" method="POST" id="thmamform">
                <div class="col-md-4 " style=" margin-top:20px;">
                    <label for="selectData" class="mb-1">اسم المستلم*</label>
                    <select class="form-control" name="emp_id">
                        <?php echo getItems('emp', 'emp_name') ?>
                    </select>
                </div>
                <div class="col-md-4 " style=" margin-top:20px;">
                    <label for="selectData" class="mb-1">الدائرة المستلمة*</label>
                    <select class="form-control" name="dep_id">
                        <?php echo getItems('dep_table', 'dep_name') ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">رقم المستند *</label>
                    <input type="text" class="form-control" id="inputPassword4" name="taghez_number">
                </div>
                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">تاريخ المستند *</label>
                    <input type="date" class="form-control" id="inputPassword4" name="taghez_date"
                        value="<?php echo date('Y-m-d'); ?>">
                </div>


                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label">الملاحضات</label>
                    <input type="text" class="form-control" id="inputEmail4" name="notes">
                </div>


                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">المستخدم</label>
                    <input type="text" class="form-control" id="inputPassword4" name="username" readonly
                        value="<?php echo $_SESSION['username'] ?>">
                </div>



                <div id="items-container">
                    <div class="row item">
                        <div class="col-md-2 mt-2">
                            <label for="selectData">المادة*</label>

                            <select class="form-control select2-choices " name="item_id">
                                <?php echo getItems('products', 'product_name') ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="inputPassword4" class="form-label">رقم الجهاز</label>
                            <input type="text" class="form-control" name="sn" value="0">
                        </div>
                        <div class="col-md-1">
                            <label for="inputPassword4" class="form-label">الكمية*</label>
                            <input type="number" class="form-control" name="quantity">
                        </div>
                        <div class="col-md-2">
                            <label for="inputPassword4" class="form-label">سعر المفرد*</label>
                            <input type="number" class="form-control" name="singlePrice" value="0">
                        </div>
                        <div class="col-md-2">
                            <label for="inputPassword4" class="form-label">الاجمالي*</label>
                            <input type="number" class="form-control" name="allPrice" value="0">
                        </div>
                        <div class="col-md-2 mt-2">
                            <label for="selectData">نوع المادة*</label>
                            <select class="form-control" name="type">
                                <option value="شراء">شراء</option>
                                <option value="هدية">هدية</option>
                            </select>
                        </div>

                    </div>
                </div>


                <div class=" mt-5 flex d-flex justify-content-start">
                    <input type="submit" value="حفظ الذمة" class="btn btn-lg btn-primary" name="submit">
                </div>
            </form>
            </div>
                </div>
            <?php
            if (!empty($error)) {
                echo "<div class='alert alert-danger mt-2 ' role='alert'>
                                    $error
                                  </div>";
            }
            if (!empty($success)) {
                echo "<div class='alert alert-success mt-2 ' role='alert'>
                                    $success
                                  </div>";
            }


            ?>
        </div>
    </section>




    <!-- Select2 CSS -->


    <!-- Select2 JS -->
    <script src="jquery-3.6.0.min.js"></script>
    <script src="jquery.validate.min.js"></script>
    <script src="select2.min.js"></script>
    <script src="script.js"></script>

</html>