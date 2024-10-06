<?php
session_start();

if (isset($_POST)) {
    $id = $_POST['gameId'];
    $thumbnail = $_POST['iThumbnail'];
    $title = $_POST['iTitle'];
    $price = $_POST['iPrice'];
    $date = $_POST['iDate'];
    $onlineStatus = $_POST['iOnlineStatus'];
    $purchases = $_POST['iPurchases'];
    $onlinePlayers = $_POST['iOnlinePlayers'];
    $players = $_POST['iPlayers'];
    $esrb = $_POST['iEsrb'];
    $legal = $_POST['iLegal'];

    if (isset($_SESSION['cart'])) {
        $session_array_id = array_column($_SESSION['cart'], 'id');
        if (!in_array($id, $session_array_id)) {
            $session_array = array(
                'id' => $id,
                'thumbnail' => $thumbnail,
                'title' => $title,
                'price' => $price,
                'date' => $date,
                'onlineStatus' => $onlineStatus,
                'purchases' => $purchases,
                'onlinePlayers' => $onlinePlayers,
                'players' => $players,
                'esrb' => $esrb,
                'legal' => $legal
            );
            $_SESSION['cart'][] = $session_array;
        }
    } else {
        $session_array = array(
            'id' => $id,
            'thumbnail' => $thumbnail,
            'title' => $title,
            'price' => $price,
            'date' => $date,
            'onlineStatus' => $onlineStatus,
            'purchases' => $purchases,
            'onlinePlayers' => $onlinePlayers,
            'players' => $players,
            'esrb' => $esrb,
            'legal' => $legal
        );
        $_SESSION['cart'][] = $session_array;
    }

    $numofOrders = count($_SESSION['cart']);
    // $cartText = '';
    // if (!in_array($id, $session_array_id)) {
    //     $cartText = 'Add to Cart';
    // } else {
    //     $cartText = 'Already In Cart';
    // }
    echo '<script> $(".cartBadge").html(' . $numofOrders . ')</script>';
}
