<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
require './config/database.php';
$sql = "select Id,FirstName,Email,Contact FROM employees";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }
    echo json_encode($emparray);
} else {
    echo "0 results";
}

$conn->close();
?>