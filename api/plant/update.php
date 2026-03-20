<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:PUT");
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
$plant->name= $data->name;
$plant->price= $data->price;
$plant->image_url= $data->image_url;
$plant->quantity= $data->quantity;
$plant->category_id= $data->category_id;

if($plant->update()){
    echo json_encode(array("message" => "Product Update successfully."));
}else{
    echo json_encode(array("message" => "Product not Update."));
}
?>