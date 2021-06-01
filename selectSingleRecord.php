<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
require './config/database.php';


$postdata = file_get_contents("php://input");

// echo json_encode($postdata);
if(isset($postdata) && !empty($postdata))
{
	$request = json_decode($postdata,true);
	// Validate.
	if(($request['id']) === '')
	{
		return http_response_code(400);
	}
	$id = mysqli_real_escape_string($conn,($request['id']));
}
// echo json_encode($id);


$sql = "select Id,FirstName,Email,Contact FROM employees where Id = '$id'";
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