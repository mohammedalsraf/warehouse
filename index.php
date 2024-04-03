<?php
include('includes/conn.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['userName']) && isset($_POST['passWord'])) {
        if ($_POST['userName'] != "" && $_POST['passWord'] != "") {
            $userName = mysqli_real_escape_string($conn, $_POST['userName']);
            $passWord = mysqli_real_escape_string($conn, $_POST['passWord']);
            $sql = "SELECT * FROM users WHERE username = '$userName'";
            $res = mysqli_query($conn, $sql);
            if ($res) {
                if (mysqli_num_rows($res) > 0) {
                    $row = mysqli_fetch_assoc($res);
                    $hashedPassword = $row['password'];
                    
                    if (password_verify($passWord, $hashedPassword)) {
                        session_start();
                        $_SESSION['username'] = $userName;
                        $_SESSION['role']=$row['role'];
                        // echo $_SESSION['username'].$_SESSION['role'];
                        header("Location: pages/home.php"); 
                        // exit();


                       
                    } else {
                        $error = "كلمة المرور خاطئه";
                    }


                } else {
                    $error = "هذا المستخدم غير موجود";
                }

            } else {
                echo mysqli_error($conn);
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
    <title>تسجيل الدخول</title>
    <link href="pages/bootstrap.min.css" rel="stylesheet">
    <script src="pages/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="pages/stylem.css">
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase"> نظام ادارة المخازن</h2>
                                <p class="text-white-50 mb-5">قم بادخال اسم المستخدم وكلمة المرور</p>
                                <form action="" method="POST">

                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="typeEmailX">اسم المستخدم</label>
                                        <input type="text" id="user" class="form-control form-control-lg"
                                            name="userName" />
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="typePasswordX">كلمة المرور</label>
                                        <input type="password" id="typePasswordX" class="form-control form-control-lg"
                                            name="passWord" />
                                    </div>

                                    <!-- <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p> -->

                                    <button class="btn btn-outline-warning btn-lg px-5" type="submit">دخول</button>
                                </form>
                                <?php
                                if (!empty($error)) {
                                    echo "<div class='alert alert-danger mt-2' role='alert'>
                                    $error
                                  </div>";
                                }



                                ?>



                                <!-- <div class="d-flex justify-content-center text-center mt-4 pt-1">
                <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
              </div> -->

                            </div>

                            <div>
                                <p class="mb-0"> تصميم وبرمجة قسم تكنولوجيا المعلومات - المبرمج محمد عزيز
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>