<?php
require './config/database.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$postdata = file_get_contents('php://input');

if(isset($postdata) && !empty($postdata))
{
 //echo json_encode($postdata,true);
	$request = json_decode($postdata,true);
	// if(($request['id']) === '' || $request['name']) === '' || ($request['email']) === '' || ($request['contact']) === ''){
	// 	return http_response_code(400);
	// }
  $id = mysqli_real_escape_string($conn,($request['id']));
	$name = mysqli_real_escape_string($conn,($request['name']));
  $email = mysqli_real_escape_string($conn, ($request['email']));
	$contact = mysqli_real_escape_string($conn, $request['contact']);


  // $id = $_REQUEST['id'];
	// $name = $_REQUEST['name'];
  // $email = $_REQUEST['email'];
	// $contact = $_REQUEST['contact'];

	$sql = "update employees SET FirstName='$name',Email='$email', Contact='$contact' WHERE Id = $id";
	
	if($conn->query($sql))
	{
		http_response_code(200);
	}
	else
	{
		return http_response_code(422);
	}
}

$conn->close();
?>