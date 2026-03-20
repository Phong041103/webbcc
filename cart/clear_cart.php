<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['itemkey'])) {
    $key = $_POST['itemkey'];
    if (isset($_SESSION['cart'][$key])) {
        unset($_SESSION['cart'][$key]); 
        $_SESSION['cart'] = array_values($_SESSION['cart']); 
    }
    header('Location: cart.php'); 
    exit();
}
?>