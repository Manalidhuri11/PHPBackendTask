<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
require './config/database.php';

$postdata = file_get_contents("php://input");


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
echo json_encode($id);

$sql = "DELETE FROM employees WHERE Id='$id'";
if($conn->query($sql))
{
	http_response_code(200);
}
else
{
	return http_response_code(422);
}

$conn->close();
?>