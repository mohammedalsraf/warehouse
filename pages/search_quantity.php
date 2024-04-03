<?php
include('../includes/conn.php');


if (isset($_POST['search']) && $_POST['keyword'] != "") {
    $keyword = $_POST['keyword'];
    $sql = "SELECT 
    p.product_name,
    COALESCE(t.takeout, 0) AS takeout,
    COALESCE(i.insertt, 0) AS insertt,
    (COALESCE(i.insertt, 0) - COALESCE(t.takeout, 0)) AS total
FROM 
    products p
LEFT JOIN (
    SELECT 
        item_id,
        SUM(quantity) AS takeout
    FROM 
        takeout_info
    GROUP BY 
        item_id
) t ON p.id = t.item_id
LEFT JOIN (
    SELECT 
        item_id,
        SUM(quantity) AS insertt
    FROM 
        insert_info
    GROUP BY 
        item_id
) i ON p.id = i.item_id
WHERE
    p.product_name LIKE '%$keyword%';

   ";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("فشل في جلب البيانات");
    }


} else {
    header('location: quantity_report.php');
    exit();

}
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بحث جرد المخزن</title>
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
                    <form method="POST" action="">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="ابحث" name="keyword">
                            <button type="submit" class="btn btn-warning me-1   btn-border-circular"
                                name="search">البحث</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true"
                    style="position: relative;">
                    <table class="table table-striped mb-0 table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" style="width:10px">التسلسل</th>
                                <th scope="col">اسم المادة</th>
                                <th scope="col" style="width:110px">اجمالي الداخل</th>
                                <th scope="col" style="width:110px">اجمالي الخارج</th>
                                <th scope="col" style="width:110px">المتبقي</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            $taslsl = 0;
                          
             
                            while ($row = mysqli_fetch_assoc($result)) {
                                $taslsl++;
                                if (is_null($row['insertt'])) {
                                    $row['insertt'] = 0;
                                }
                                if (is_null($row['takeout'])) {
                                    $row['takeout'] = 0;
                                }
                                if (is_null($row['total'])) {
                                    $row['total'] = $row['insertt'] - $row['takeout'];
                                }

                                echo "<tr>";
                                echo "<td>" . $taslsl . "</td>";
                                echo "<td>" . $row['product_name'] . "</td>";
                                echo "<td>" . $row['insertt'] . "</td>";
                                echo "<td>" . $row['takeout'] . "</td>";
                                echo "<td>" . $row['total'] . "</td>";

                                echo "</tr>";
                                // mysqli_free_result($result);
                            }

                            // Release the result set
                          
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