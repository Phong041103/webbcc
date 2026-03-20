<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");
include_once '../../config/db.php';
include_once '../../model/plant.php'; 

//create db object
$db = new db();
$connect= $db->connect();

$plant = new Plant($connect);
$plant->product_id= isset($_GET['product_id']) ? $_GET['product_id'] : die();

$plant->show();

$plant_item= array(
    "plant_id" => $plant->product_id,
    "name" => $plant->name,
    "price" => $plant->price,
    "image_url" => $plant->image_url,
    "quantity" => $plant->quantity,
    "category_id" => $plant->category_id
);
print_r(json_encode($plant_item));




?>