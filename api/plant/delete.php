<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:DELETE");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,Access-Control-Allow-Methods, Authorization, X-Requested-With");
include_once '../../config/db.php';
include_once '../../model/plant.php'; 

//create db object
$db = new db();
$connect= $db->connect();

$plant = new Plant($connect);

$data=json_decode(file_get_contents("php://input"));

$plant->product_id= $data->product_id;


if($plant->delete()){
    echo json_encode(array("message" => "Product Delete successfully."));
}else{
    echo json_encode(array("message" => "Product not Delete."));
}
?>