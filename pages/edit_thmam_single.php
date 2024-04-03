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
$id = $_GET['id'];
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

            $sqli = "UPDATE thmam_single SET emp_id='$emp_id',dep_id='$dep_id',taghez_number='$taghez_number',taghez_date='$taghez_date',notes='$notes',username='$username',
            item_id='$item_id',quantity='$quantity',singlePrice='$singlePrice',allPrice='$allPrice',type='$type',sn='$sn'
            WHERE thmam_single.id='$id';
            ";
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
                $success = "تم تحديث قيد الذمة  بنجاح";


                // Close the database connection
                $conn->close();
                header("location: view_thmam_single.php?msg=$success");
                exit();
            }
        } else {
            $error = "الحقول المشار لها ب (*) مطلوبة تاكد من ملئها";
        }

    }
} else {
    $sql = "SELECT thmam_single.*,emp.emp_name ,dep_table.dep_name,dep_table.id,products.product_name FROM thmam_single 
    INNER JOIN emp ON thmam_single.emp_id=emp.id
    INNER JOIN dep_table ON thmam_single.dep_id=dep_table.id
    INNER JOIN products ON thmam_single.item_id=products.id
    WHERE thmam_single.id='$id'
    ";
    $res = mysqli_query($conn, $sql);
    if ($res) {

    } else {
        echo mysqli_error($conn);
    }
    $row = mysqli_fetch_assoc($res);

}
///////////////////////////////////////////////////////////////////////////////////////////////
?>
<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> تعديل ذمة موظف</title>
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
                <h3>تعديل قيد ذمة موظف </h3>
            </div>
            <div class="card-body">
            <form class="row g-3" method="POST" id="editthmam">
                <div class="col-md-4" style="margin-top:20px;">
                    <label for="selectData" class="mb-1">اسم المستلم*</label>
                    <select class="form-control" name="emp_id">
                        <?php  
                        echo getItemsWithS('emp', 'emp_name', $row['emp_id']); 
                        
                        ?>
                    </select>
                </div>
                <div class="col-md-4 " style=" margin-top:20px;">
                    <label for="selectData" class="mb-1">الدائرة المستلمة*</label>
                    <select class="form-control" name="dep_id">
                        <?php
                  
                        echo getItemsWithS('dep_table', 'dep_name', $row['dep_id']);
                        
                        ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">رقم المستند *</label>
                    <input type="text" class="form-control" id="inputPassword4" name="taghez_number"
                        value="<?php
                   
                        echo $row['taghez_number'] ;
                        
                        ?>">
                </div>
                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">تاريخ المستند *</label>
                    <input type="date" class="form-control" id="inputPassword4" name="taghez_date"
                        value="<?php
               
                        echo $row['taghez_date'];
                        
                         ?>">
                </div>


                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label">الملاحضات</label>
                    <input type="text" class="form-control" id="inputEmail4" name="notes"
                        value="<?php 
                
                        echo $row['notes'] ;
                        
                        ?>">
                </div>


                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">المستخدم</label>
                    <input type="text" class="form-control" id="inputPassword4" name="username" readonly
                        value="<?php 
                   
                        echo $_SESSION['username'] ;
                        
                        ?>">
                </div>



                <div id="items-container">
                    <div class="row item">
                        <div class="col-md-2 mt-2">
                            <label for="selectData">المادة*</label>

                            <select class="form-control select2-choices " name="item_id">
                                <?php 
                       
                                echo getItemsWithS('products', 'product_name', $row['item_id']);
                                
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="inputPassword4" class="form-label">رقم الجهاز</label>
                            <input type="text" class="form-control" name="sn" value="<?php
                     
                            echo $row['sn'] ;
                            ?>">
                        </div>
                        <div class="col-md-1">
                            <label for="inputPassword4" class="form-label">الكمية*</label>
                            <input type="number" class="form-control" name="quantity"
                                value="<?php 
                     
                                echo $row['quantity'] ;?>">
                        </div>
                        <div class="col-md-2">
                            <label for="inputPassword4" class="form-label">سعر المفرد*</label>
                            <input type="number" class="form-control" name="singlePrice"
                                value="<?php 
                     
                                echo $row['singlePrice']; 
                                
                                ?>">
                        </div>
                        <div class="col-sm-2">
                            <label for="inputPassword4" class="form-label">الاجمالي*</label>
                            <input type="number" class="form-control" name="allPrice"
                                value="<?php
     
                                echo $row['allPrice'] ;?>">
                        </div>
                        <div class="col-md-1 mt-2">
                            <label for="selectData">نوع المادة*</label>
                            <select class="form-control" name="type">
                                <option value="شراء" <?php
               
                                if ($row['type']=="شراء"){echo "selected";} 
                                
                                ?>>شراء</option>
                                <option value="هدية" <?php 

                                if ($row['type']=="هدية"){echo "selected";}
                                
                                ?>>هدية</option>
                            </select>
                        </div>

                    </div>
                </div>


                <div class=" mt-5 flex d-flex justify-content-start">
                    <input type="submit" value="حفظ الذمة" class="btn btn-lg btn-primary" name="submit">
                </div>
            </form>
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

</html>