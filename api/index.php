<?php

header('Content-Type: application/json; charset=utf-8');
require_once($_SERVER['DOCUMENT_ROOT']."/api/Classes/Class.Main.php");


$requestData = json_decode(file_get_contents('php://input'), true);
$action = $requestData['Action'];
$payload = $requestData['Payload'];

$DISwipe = new DISwipe();

$response = new Response(400, null, "Failed to Complete Operation: ".$area."/".$action);

if ($action == "Swipe") {
    $ID = $payload->ID;
    $SwipeRight = $payload->SwipeRight;

    $response = $DISwipe->HandleSwipe($ID, $SwipeRight);    
}


echo json_encode($response)

?>