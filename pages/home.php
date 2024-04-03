<?php 
session_start();
if(!isset($_SESSION['username'] ) ) {
    header("Location: ../index.php"); 
    exit();
}
include('../includes/conn.php');

$sql='SELECT
(SELECT COUNT(*) FROM products) AS p_total,
(SELECT COUNT(*) FROM vendors) AS v_total,
(SELECT COUNT(*) FROM emp) AS e_total,
(SELECT COUNT(*) FROM insert_basic) AS i_total,
(SELECT COUNT(*) FROM takeout_basic) AS t_total,
(SELECT COUNT(*) FROM dep_table) AS d_total;
';

$res = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($res);
  






?>



<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الرئيسية</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="select22.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="stylem.css">
        

        
        <style>
            .demo{ background-color: #e7e7e7; }
.counter{
    
    background: #fff;
    text-align: center;
    width: 200px;
    min-height: 215px;
    padding: 10px 15px;
    margin: 0 auto;
    border-radius: 30px;
    box-shadow: 0 8px 5px rgba(0, 0, 0, 0.2);
    position: relative;
}
.counter:before{
    content: '';
    background-color: #9DD662;
    height: 105px;
    width: 100%;
    border-radius: 30px 30px 0 0;
    position: absolute;
    left: 0;
    top: 0;
}
.counter .counter-icon{
    color: #fff;
    background: #7CA936;
    font-size: 50px;
    line-height: 90px;
    width: 120px;
    height: 100px;
    margin: 0 auto 10px;
    border-radius: 10px 10px 0 0;
    transform: translateY(-20px);
    position: relative;
    clip-path: polygon(0% 0%, 100% 0, 100% 70%, 50% 100%, 0 70%);
}
.counter .counter-icon:before{
    content: "";
    background: #8AC248;
    width: 120px;
    height: 90px;
    border-radius: 10px 10px 0 0;
    transform: translateX(-50%);
    position: absolute;
    top: 0;
    left: 50%;
    z-index: -1;
    clip-path: polygon(0% 0%, 100% 0, 100% 70%, 50% 100%, 0 70%);
}
.counter:hover .counter-icon i{
    transform: rotate(360deg);
    transition: all 0.3s ease;
}
.counter h3{
    color: #333;
    font-size:17px;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin: 0 0 5px 0;
}
.counter .counter-value{
    color: #7CA936;
    font-size: 30px;
    font-weight: 600;
    display: block;
}
.counter.blue:before{ background-color: #5A9BEF; }
.counter.blue .counter-icon{ background-color: #2A70B5; }
.counter.blue .counter-icon:before{ background-color: #367DCB; }
.counter.blue .counter-value{ color: #367DCB; }
.counter.red:before{ background-color: #FD6D4B; }
.counter.red .counter-icon{ background-color: #D14026; }
.counter.red .counter-icon:before{ background-color: #EA5736; }
.counter.red .counter-value{ color: #EA5736; }
.counter.gray:before{ background-color: #777; }
.counter.gray .counter-icon{ background-color: #444; }
.counter.gray .counter-icon:before{ background-color: #666; }
.counter.gray .counter-value{ color: #666; }
@media screen and (max-width:990px){
    .counter{ margin-bottom: 40px; }
}

  /* ... (your existing styles) */

  @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideInLeft {
        from {
            transform: translateX(-100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .row-one {
        animation: slideInRight 2s ease-out;
    }

    .row-two {
        animation: slideInLeft 2s ease-out;
    }
        </style>
</head>
<body  class=" insertbg">
<?php
include("../includes/menu.php")
?>
<div>
<div class="container mt-5">
    <div class="row row-one">
        <div class="col-md-3 col-sm-6">
            <div class="counter">
                <div class="counter-icon">
                    <i class="fa fa-globe"></i>
                </div>
                <div class="counter-content">
                    <h3>عدد المواد</h3>
                    <span class="counter-value">
                        <?php echo $row['p_total'] ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="counter blue">
                <div class="counter-icon">
                    <i class="fa fa-handshake-o"></i>
                </div>
                <div class="counter-content">
                    <h3>عدد المجهزين </h3>
                    <span class="counter-value">
                    <?php echo $row['v_total'] ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="counter gray">
                <div class="counter-icon">
                    <i class="fa fa-user"></i>
                </div>
                <div class="counter-content">
                    <h3>عدد المستلمين </h3>
                    <span class="counter-value">
                    <?php echo $row['e_total'] ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="counter red">
                <div class="counter-icon">
                    <i class="fa fa-arrow-up"></i>
                </div>
                <div class="counter-content">
                    <h3>عدد سندات الادخال</h3>
                    <span class="counter-value">
                    <?php echo $row['i_total'] ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5 row-two">
        <div class="col-md-3 col-sm-6">
            <div class="counter">
                <div class="counter-icon">
                    <i class="fa fa-arrow-down"></i>
                </div>
                <div class="counter-content">
                    <h3>عدد سندات الاخراج</h3>
                    <span class="counter-value">
                    <?php echo $row['t_total'] ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="counter blue">
                <div class="counter-icon">
                    <i class="fa fa-building"></i>
                </div>
                <div class="counter-content">
                    <h3>عدد الدوائر </h3>
                    <span class="counter-value">
                    <?php echo $row['d_total'] ?>
                    </span>
                </div>
            </div>
        </div>
       
       
    </div>
</div>
</div>
</script><script type="text/javascript" src="jquery-3.6.0.min.js"></script>
 
<script>
    $(document).ready(function(){
    $('.counter-value').each(function(){
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        },{
            duration: 3500,
            easing: 'swing',
            step: function (now){
                $(this).text(Math.ceil(now));
            }
        });
    });
});
   
</script>
    
</body>
</html>