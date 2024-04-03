<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
if ($_SESSION['role'][15] == 0) {
    header("Location: ../pages/home.php");

}
include('../includes/conn.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['userName']) && isset($_POST['passWord'])) {
        if ($_POST['userName'] != "" && $_POST['passWord'] != "") {
            $enter = $takeout = $view_insert = $view_takeout = $q_report = $add_vendors = $view_vendors = $add_emp = $view_vendors = $add_thmam
                = $view_thmam = $view_emp = $add_dep = $view_dep = $add_product = $view_product = $add_user = 0;
            /// scape the spicial char for security resones
            $userName = mysqli_real_escape_string($conn, $_POST['userName']);
            $passWord = mysqli_real_escape_string($conn, $_POST['passWord']);
            $hashedPassword = password_hash($passWord, PASSWORD_DEFAULT);
            $checkUsernameQuery = "SELECT * FROM users WHERE username = '$userName'";
            $checkUsernameResult = mysqli_query($conn, $checkUsernameQuery);

            if (mysqli_num_rows($checkUsernameResult) > 0) {
                $error = "اسم المستخدم موجود بالفعل. يرجى اختيار اسم مستخدم آخر.";
            } else {

                if (isset($_POST['insert'])) {
                    $insert = $_POST['insert'];
                }
                if (isset($_POST['takeout'])) {
                    $takeout = $_POST['takeout'];
                }
                if (isset($_POST['view_insert'])) {
                    $view_insert = $_POST['view_insert'];
                }
                if (isset($_POST['view_takeout'])) {
                    $view_takeout = $_POST['view_takeout'];
                }
                if (isset($_POST['q_report'])) {
                    $q_report = $_POST['q_report'];
                    ;
                }
                if (isset($_POST['add_vendors'])) {
                    $add_vendors = $_POST['add_vendors'];
                }
                if (isset($_POST['view_vendors'])) {
                    $view_vendors = $_POST['view_vendors'];
                }
                if (isset($_POST['add_emp'])) {
                    $add_emp = $_POST['add_emp'];
                }
                if (isset($_POST['add_thmam'])) {
                    $add_thmam = $_POST['add_thmam'];
                }
                if (isset($_POST['view_thmam'])) {
                    $view_thmam = $_POST['view_thmam'];
                }
                if (isset($_POST['view_emp'])) {
                    $view_emp = $_POST['view_emp'];
                }
                if (isset($_POST['add_dep'])) {
                    $add_dep = $_POST['add_dep'];
                }
                if (isset($_POST['view_dep'])) {
                    $view_dep = $_POST['view_dep'];
                }
                if (isset($_POST['add_product'])) {
                    $add_product = $_POST['add_product'];
                }
                if (isset($_POST['view_product'])) {
                    $view_product = $_POST['view_product'];
                }
                if (isset($_POST['add_user'])) {
                    $add_user = $_POST['add_user'];
                }
                $role = $insert . $takeout . $view_insert . $view_takeout . $q_report . $add_vendors . $view_vendors . $add_emp . $add_thmam . $view_emp . $view_emp . $add_dep .
                    $view_dep . $add_product . $view_product . $add_user;
                $sql = "INSERT INTO users (username,password,role) VALUES ('$userName','$hashedPassword','$role')";
                $res = mysqli_query($conn, $sql);
                if ($res) {
                    $success = "تم اضافة المستخدم بنجاح";
                } else {
                    echo mysqli_error($conn);
                }



            }
        } else {
            $error = "حقل اسم المستخدم وكلمة المرور لايمكن ان يكون فارغا";
        }

    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اضافة مستخدمين</title>
    <link href="../pages/bootstrap.min.css" rel="stylesheet">
    <script src="../pages/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../pages/stylem.css">
</head>

<body>
    <?php include("../includes/menu.php") ?>
    <section class=" gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase"> نظام ادارة المخازن</h2>
                                <p class="text-white-50 mb-5">قم بادخال اسم المستخدم وكلمة المرور وحدد صلاحيات المستخدم
                                </p>

                                <form action="" method="POST">
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="typeEmailX">اسم المستخدم</label>
                                        <input type="text" id="typeEmailX" class="form-control form-control-lg"
                                            name="userName" />
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="typePasswordX">كلمة المرور</label>
                                        <input type="password" id="typePasswordX" class="form-control form-control-lg"
                                            name="passWord" />
                                    </div>
                                    <div class="container mt-3">
                                        <h2>صلاحيات المستخدم</h2>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="checkbox1"
                                                name="insert">
                                            <label class="form-check-label" for="checkbox1">
                                                سند ادخال
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="checkbox2"
                                                name="takeout">
                                            <label class="form-check-label" for="checkbox2">
                                                سند اخراج
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="checkbox3"
                                                name="view_insert">
                                            <label class="form-check-label" for="checkbox3">
                                                عرض سندات الادخال
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="checkbox1"
                                                name="view_takeout">
                                            <label class="form-check-label" for="checkbox1">
                                                عرض سندات الاخراج
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="checkbox2"
                                                name="q_report">
                                            <label class="form-check-label" for="checkbox2">
                                                جرد المخزن
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="checkbox3"
                                                name="add_vendors">
                                            <label class="form-check-label" for="checkbox3">
                                                تعريف المجهزين
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="checkbox1"
                                                name="view_vendors">
                                            <label class="form-check-label" for="checkbox1">
                                                عرض المجهزين
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="checkbox1"
                                                name="add_emp">
                                            <label class="form-check-label" for="checkbox1">
                                                اضافة موظفين
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="checkbox1"
                                                name="add_thmam">
                                            <label class="form-check-label" for="checkbox1">
                                                اضافة قيد ذمة
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="checkbox1"
                                                name="view_thmam">
                                            <label class="form-check-label" for="checkbox1">
                                                عرض قيود الذمة
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="checkbox1"
                                                name="view_emp">
                                            <label class="form-check-label" for="checkbox1">
                                                عرض الموظفين والذمم
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="checkbox1"
                                                name="add_dep">
                                            <label class="form-check-label" for="checkbox1">
                                                اضافة اقسام
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="checkbox1"
                                                name="view_dep">
                                            <label class="form-check-label" for="checkbox1">
                                                عرض الاقسام والذمم
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="checkbox1"
                                                name="add_product">
                                            <label class="form-check-label" for="checkbox1">
                                                اضافة مواد
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="checkbox1"
                                                name="view_product">
                                            <label class="form-check-label" for="checkbox1">
                                                عرض المواد
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="checkbox1"
                                                name="add_user">
                                            <label class="form-check-label" for="checkbox1">
                                                اضافة مستخدمين
                                            </label>
                                        </div>




                                    </div>

                                    <!-- <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p> -->

                                    <div class="mt-2">
                                        <button class="btn btn-outline-warning btn-lg px-5" type="submit">اضافة
                                            مستخدم</button>
                                    </div>
                                </form>
                                <?php
                                if (!empty($error)) {
                                    echo "<div class='alert alert-danger mt-2' role='alert'>
                                    $error
                                  </div>";
                                }
                                if (!empty($success)) {
                                    echo "<div class='alert alert-success mt-2' role='alert'>
                                    $success
                                  </div>";
                                }


                                ?>
                                <!-- <div>
                                    <p><a href="addusers.php"
                                            class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">اضافة
                                            مستخدمين</a>
                                        </p>
                                </div> -->



                                <!-- <div class="d-flex justify-content-center text-center mt-4 pt-1">
                <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
              </div> -->

                            </div>

                            <div>
                                <!-- <p class="mb-0"> تصميم وبرمجة قسم تكنولوجيا المعلومات - المبرمج محمد عزيز
                                </p> -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>