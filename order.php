<?php
include('db.php');
session_start();
$totalItems = 0;
$totalPrice = 0;
if (isset($_POST['order'])) {
    if (isset($_SESSION['cart'])) {
        $userId = $_SESSION['id'];
        $gamesId = json_encode(array_column($_SESSION['cart'], 'id'));
        $totalItems = count($_SESSION['cart']);
        foreach ($_SESSION['cart'] as $key => $value) {
            $totalPrice = $totalPrice + $value['price'];
        }

        $sql = "INSERT INTO order_games(user_id,games_id,total_items,total_price,purchased_date)
                VALUES ('$userId','$gamesId','$totalItems','$totalPrice',now())";
        mysqli_query($conn, $sql);
        unset($_SESSION['cart']);

        if (!isset($_SESSION['cart'])) {
            echo '<p>Order placed successfully</p>';
        }
    } else {
        echo '<p>Please only use one window when you place order</p>';
    }
}
