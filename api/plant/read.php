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
$read= $plant->read();

$num = $read->rowCount();
if($num > 0){
    $plant_arr = array();
    $plant_arr["plant"] = array();
    while($row = $read->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $plant_item = array(
            "product_id" => $product_id,
            "name" => $name,
            "price" => $price,
            "image_url" => $image_url,
            "quantity" => $quantity,
            "category_id" => $category_id
        );
        array_push($plant_arr["plant"],$plant_item);
    }
    echo json_encode($plant_arr);
}
?>