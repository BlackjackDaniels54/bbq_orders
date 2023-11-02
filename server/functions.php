<?php
    

    function getProducts ($connect) {
        $products = mysqli_query($connect, "SELECT * FROM `products`");
            $product_list = [];
            while($product = mysqli_fetch_assoc($products)) {
                $product_list[] = $product;
            }
            echo json_encode($product_list);
         
    }

    function getProductById($connect, $id) {
        $product = mysqli_query($connect, "SELECT * FROM `products` WHERE `id` = '$id'");

        if(mysqli_num_rows($product) === 0) {
            http_response_code(404);
            $res = [
                "status" => false,
                "message" => "Product is not found"
            ];
            echo json_encode($res);
        } else {
            $product = mysqli_fetch_assoc($product);
            echo json_encode($product);
           
        }
    }
    function addProduct($connect, $data) {
        $name = $data['name'];
        $price = $data['price'];

        mysqli_query($connect, "INSERT INTO `products`(`id`, `name`, `price`) VALUES (NULL,'$name','$price')");
        
        http_response_code(201);

        $res = [
            "status" => true,
            "product_id" => mysqli_insert_id($connect)
        ];

        echo json_encode($res);
    }


    function updateProduct($connect, $id, $data) {
        $name = $data['name'];
        $price = $data['price'];

        mysqli_query($connect, "UPDATE `products` SET `name`='$name',`price`='$price' WHERE `products` . `id` = '$id'");
        
        http_response_code(200);
        $res = [
            "status" => true,
            "message" => "The post is Updated!"
        ];

        echo json_encode($res);
    }

    function deleteProduct($connect, $id) {
        mysqli_query($connect, "DELETE FROM `products` WHERE `products` . `id` = '$id'");
        
        http_response_code(200);
        
        $res = [
            "status" => true,
            "message" => "The post is Deleted!"
        ];

        echo json_encode($res);
    
    }




    function getOrderById($connect, $id) {
        $order = mysqli_query($connect, "SELECT * FROM `orders` WHERE `id` = '$id'");

        if(mysqli_num_rows($order) === 0) {
            http_response_code(404);
            $res = [
                "status" => false,
                "message" => "Order is not found"
            ];
            echo json_encode($res);
        } else {
            $order = mysqli_fetch_assoc($order);
            echo json_encode($order);
           
        }
    }
    function getOrders($connect) {
        $orders = mysqli_query($connect, "SELECT * FROM `orders`");
            $order_list = [];
            while($order = mysqli_fetch_assoc($orders)) {
                $order_list[] = $order;
            }
            echo json_encode($order_list);
    }

    function addOrder($connect, $data) {
        $name_client = $data['name_client'];
        $phone_client = $data['phone_client'];
        $is_delivery = $data['is_delivery'];
        $address = $data['address'];
        $order_list = $data['order_list'];
        $date_time = $data['date_time'];
        $comment = $data['comment'];
        $total_price = $data['total_price'];

        mysqli_query($connect, "INSERT INTO `orders`(`id`,`name_client`, `phone_client`, `is_delivery`, `address`, `order_list`, `date_time`, `comment`, `total_price`) VALUES (NULL,'$name_client','$phone_client','$is_delivery','$address','$order_list','$date_time','$comment','$total_price')");
        
        http_response_code(201);

        $res = [
            "status" => true,
            "product_id" => mysqli_insert_id($connect)
        ];

        echo json_encode($res);
    }


    function updateOrder($connect, $id, $data) {

    }

?>
