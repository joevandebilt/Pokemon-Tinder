<?php

header('Content-Type: application/json; charset=utf-8');
require_once($_SERVER['DOCUMENT_ROOT']."/api/Classes/Class.Main.php");

$response = new Response(200, null, "OK");
$requestData = json_decode(file_get_contents('php://input'), true);
if ($requestData != null) {

    $action = $requestData['Action'];
    $payload = $requestData['Payload'];

    $response = new Response(400, null, "Failed to Complete Operation: ".$action);

    $DIPokemon = new DIPokemon();
    $DISwipe = new DISwipe();

    if ($action == "Swipe") 
    {
        $ID = $payload["ID"];
        $SwipeRight = $payload["SwipeRight"];

        $response = $DISwipe->HandleSwipe($ID, $SwipeRight);    
    } 
    else if ($action == "GetPokemonList") 
    {
        $response = $DIPokemon->GetAllPokemon();
    }
    else if ($action == "GetPokemon")
    {
        $id = $payload;
        $response = $DIPokemon->GetPokemon($id);
    }
}
echo json_encode($response);

?>