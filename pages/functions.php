<?php 

function getItems($table,$field){
    include('../includes/conn.php');
    $sql = "SELECT * FROM $table ORDER BY $field";
$res = mysqli_query($conn, $sql);
$options = "";
while ($row = $res->fetch_assoc()) {
    $options .= "<option value='" . $row['id'] . "'>" . $row["$field"] . "</option>";
}
return $options;
}

function getSum($table,$field,$id){
    include('../includes/conn.php');
    $sql="SELECT SUM($field) As total  FROM $table WHERE insert_id=$id ";
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    return $row['total'];
}
function getSumTakeout($table,$field,$id){
    include('../includes/conn.php');
    $sql="SELECT SUM($field) As total  FROM $table WHERE takeout_id=$id ";
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    return $row['total'];
}
function getItemsWithS($table, $column, $selectedId = null) {
    include('../includes/conn.php');

    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);

    $options = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $empId = $row['id'];
        $empName = $row["$column"];
        
        // Check if the current employee is the selected one
        $isSelected = ($selectedId !== null && $selectedId == $empId) ? 'selected' : '';

        $options .= "<option value='$empId' $isSelected>$empName</option>";
    }

    // Close database connection here

    return $options;
}





?>