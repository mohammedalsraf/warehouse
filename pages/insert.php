<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
if ($_SESSION['role'][0] == 0) {
    header("Location: home.php");
}

include('../includes/conn.php');
include('functions.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submit'])) {
        if ($_POST['vendor_id'] != "" && $_POST['doc_number'] != "" && $_POST['istlam_number'] != "" && $_POST['rlegna'] != ""
        &&$_POST['quantity'][0]!=""&&$_POST['singlePrice'][0]!=""&&$_POST['allPrice'][0]!=""
        
        ) {

            $vendor_id = $_POST['vendor_id'];
            $doc_number = $_POST['doc_number'];
            $doc_date = $_POST['doc_date'];
            $istlam_number = $_POST['istlam_number'];
            $istlam_date = $_POST['istlam_date'];
            $notes = $_POST['notes'];
            $rlegna = $_POST['rlegna'];
            $username = $_POST['username'];

            $sqli = "INSERT INTO insert_basic (vendor_id,doc_number,doc_date,istlam_number,istlam_date,notes,rlegna,username) VALUES 
        ('$vendor_id','$doc_number','$doc_date','$istlam_number','$istlam_date','$notes','$rlegna','$username')";
            $res = mysqli_query($conn, $sqli);
            if ($res) {
                $last_inserted_id = mysqli_insert_id($conn);

                $items = $_POST['item'];
                $quantities = $_POST['quantity'];
                $singlePrice = $_POST['singlePrice'];
                $allPrice = $_POST['allPrice'];
                $type = $_POST['type'];

                for ($i = 0; $i < count($items); $i++) {
                    $item_id = $items[$i];
                    $quantity = $quantities[$i];
                    $singlePricee = $singlePrice[$i];
                    $allPricee = $allPrice[$i];
                    $typee = $type[$i];

                    $sql = "INSERT INTO insert_info (insert_id,item_id,quantity,singlePrice,allPrice,type) VALUES
                 ('$last_inserted_id','$item_id','$quantity','$singlePricee','$allPricee','$typee')";
                    mysqli_query($conn, $sql);
                }

                $conn->close();
                $success="تم انجاز قيد الادخال المخزني بنجاح";
            }
        }else{
            $error="الحقول المشار لها ب (*) مطلوبة تاكد من ملئها";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سند ادخال</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="select22.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="stylem.css">


</head>

<body class="insertbg">
    <?php
    include("../includes/menu.php");
    ?>

    <section >
        <div class="container mt-3 ">
           <div class="card shadow">
            <div class="card-header">
                <h3>انشاء قيد ادخال المخزني</h3>
            </div>
            <div class="card-body">
            <form class="row g-3" method="POST" id="insertform">
                <div class="col-md-4" style="margin-top:20px ;">
                    <label for="selectData" class="mb-1">المجهز*</label>
                    <select class="form-control select2 custom-select-height" name="vendor_id" id="vendorSelect">
                        <?php echo getItems('vendors', 'vendor_name') ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">رقم مستند الاستلام *</label>
                    <input type="text" class="form-control"  name="doc_number" id="doc_number" >
                </div>
                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">تاريخ مستند الاستلام *</label>
                    <input type="date" class="form-control" id="inputPassword4" name="doc_date"
                        value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label">رقم كتاب الاستلام *</label>
                    <input type="text" class="form-control" name="istlam_number">
                </div>
                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">تاريخ كتاب الاستلام *</label>
                    <input type="date" class="form-control" id="inputPassword4" name="istlam_date"
                        value="<?php echo date('Y-m-d'); ?>">
                </div>

                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label">الملاحضات</label>
                    <input type="text" class="form-control"  name="notes">
                </div>
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label">رئيس اللجنة *</label>
                    <input type="text" class="form-control" id="rlegna" name="rlegna">
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

                            <select class="form-control select2-choices " name="item[]">
                                <?php echo getItems('products', 'product_name') ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="inputPassword4" class="form-label">الكمية*</label>
                            <input type="number" class="form-control" name="quantity[]">
                        </div>
                        <div class="col-md-2">
                            <label for="inputPassword4" class="form-label">سعر المفرد *</label>
                            <input type="number" class="form-control" name="singlePrice[]">
                        </div>
                        <div class="col-md-2">
                            <label for="inputPassword4" class="form-label">الاجمالي *</label>
                            <input type="number" class="form-control" name="allPrice[]">
                        </div>
                        <div class="col-md-2 mt-2">
                            <label for="selectData">نوع المادة *</label>
                            <select class="form-control" name="type[]">
                                <option value="شراء">شراء</option>
                                <option value="هدية">هدية</option>
                            </select>
                        </div>
                        <div class="col-md-2 rmvbtn">
                            <label>&nbsp;</label>
                            <button type="button" class="btn btn-danger" onclick="removeItem(this)">حذف مادة</button>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="button" class="btn btn-success" onclick="cloneItem()">اضافة مادة</button>
                </div>


                <div class=" mt-5 flex d-flex justify-content-start">
                    <input type="submit" value="حفظ الادخال" class="btn btn-lg btn-primary" name="submit">
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



    <script src="jquery-3.6.0.min.js"></script>
    <script src="jquery.validate.min.js"></script>
    <script src="select2.min.js"></script>
    <script src="script.js"></script>


      
    </script>


</body>

</html>