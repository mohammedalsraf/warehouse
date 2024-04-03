<?php
include('../includes/conn.php');

$sql = "SELECT 
        p.product_name,
        COALESCE(i.insertt, 0) AS insertt,
        COALESCE(t.takeout, 0) AS takeout,
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
    ) i ON p.id = i.item_id";

$res = mysqli_query($conn, $sql);

if (!$res) {
    die("فشل في جلب البيانات");
}
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>تقرير المخزن</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap.bundle.min.js"></script>
   
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="stylem.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .table-container {
            margin-top: 20px;
        }
        @media print {
            @page {
                size: A4 portrait; /* Set page size to A4 and orientation to landscape */
                margin: 0; /* Reset default margin */
               
            }
            

            body {
                margin: 1.5cm; /* Set margin for content */
                font-family: 'Cairo', sans-serif;
               
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container-fluid">
        <div class="table-container">
            <?php echo "<h5 style='text-align: left;'>التاريخ: " . date('Y-m-d') . "</h5>"; ?>
            <h1 class="text-center">تقرير المخزن</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">التسلسل</th>
                        <th scope="col">اسم المادة</th>
                        <th scope="col">اجمالي الداخل</th>
                        <th scope="col">اجمالي الخارج</th>
                        <th scope="col">المتبقي</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $taslsl = 0;
                    while ($row = mysqli_fetch_assoc($res)) {
                        $taslsl++;
                        echo "<tr>";
                        echo "<td>" . $taslsl . "</td>";
                        echo "<td>" . $row['product_name'] . "</td>";
                        echo "<td>" . $row['insertt'] . "</td>";
                        echo "<td>" . $row['takeout'] . "</td>";
                        echo "<td>" . $row['total'] . "</td>";
                        echo "</tr>";
                    }
                    mysqli_free_result($res);
                    ?>
                </tbody>
            </table>
        </div>
    </div>

        <script>
        // Redirect user to a specific page after printing or canceling print
        window.onafterprint = function() {
            window.location.href = "quantity_report.php"; // Change "specific_page.php" to your desired page
        };
    </script>
</body>

</html>

<?php
mysqli_close($conn);
?>
