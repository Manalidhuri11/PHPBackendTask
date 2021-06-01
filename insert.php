<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
require './config/database.php';

$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata))
{
	$request = json_decode($postdata,true);
	// Validate.
	if(($request['name']) === '' || ($request['email']) === '' || ($request['contact']) === '')
	{
		return http_response_code(400);
	}
	$name = mysqli_real_escape_string($conn,($request['name']));
  $email = mysqli_real_escape_string($conn, ($request['email']));
	$contact = mysqli_real_escape_string($conn, $request['contact']);
	$sql = "INSERT INTO employees (FirstName, Email, Contact)VALUES ('$name', '$email', '$contact')";
	if($conn->query($sql))
	{
		http_response_code(201);
		$data = [
		'name' => $name,
    'email' => $email,
		'contact' => $contact];
		echo json_encode($data);
	}
	else
	{
		http_response_code(422);
	}
}