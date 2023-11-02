<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: *');
    header('Access-Control-Allow-Methods: *');
    header('Access-Control-Allow-Credentials: true');

    header('Content-type: json/application');

    require 'connection.php';
    require 'functions.php';

    $method = $_SERVER['REQUEST_METHOD'];

    $q = $_GET['q'];
    $params = explode('/', $q);

    $type = $params[0];
    $id = $params[1];

   

    if($method === 'GET'){
        if($type === 'products') {
                if(isset($id)){
                    getProductById($connect, $id);
                } else {
                    getProducts($connect);
                }
        }elseif($type === 'orders') {
            if(isset($id)){
                getOrderById($connect, $id);
            } else {
                getOrders($connect);
            }
        }
    } elseif ($method === 'POST') {
        if($type === 'products'){
            addProduct($connect, $_POST);
        }elseif ($type === 'orders') {
            addOrder($connect, $_POST);
        }
    } elseif ($method === 'PATCH') {
        if($type === 'products') {
            if(isset($id)) {
                $data = file_get_contents('php://input');
                $data = json_decode($data, true);
                
                updateProduct($connect, $id, $data);
            }
        }elseif ($type === 'orders') {
            if(isset($id)) {
                $data = file_get_contents('php://input');
                $data = json_decode($data, true);
                updateOrder($connect, $id, $data);
            }
        }
    }elseif ($method === 'DELETE') {
        if($type === 'products') {
            if(isset($id)) {
                
                deleteProduct($connect, $id);
            }
        }
    }

?>