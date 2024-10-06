<?php
include('db.php');
session_start();
if (isset($_POST['input'])) {
    if (isset($_SESSION['id'])) {
        $userId = $_SESSION['id'];
    }
    $input = $_POST['input'];
    $ordersql = mysqli_query($conn, "SELECT games_id,ispurchased FROM order_games WHERE user_id='$userId'");
    if ($input == "") {
        while ($orderrow = mysqli_fetch_assoc($ordersql)) {
            if ($orderrow['ispurchased'] == 1) {
                $games_ids = json_decode($orderrow['games_id']);
                $gamessql = mysqli_query($conn, "SELECT thumbnail FROM games_data WHERE id IN (" . implode(',', $games_ids) . ")");
                while ($gamesrow = mysqli_fetch_assoc($gamessql)) {
                    echo '<div id="game_card"><img class="test_2 rounded-3 mt-3" width="120px" height="120px" src="images/' . $gamesrow['thumbnail'] . '"></div>';
                }
            }
        }
    } else {
        while ($orderrow = mysqli_fetch_assoc($ordersql)) {
            if ($orderrow['ispurchased'] == 1) {
                $games_ids = json_decode($orderrow['games_id']);
                $gamessql = mysqli_query($conn, "SELECT thumbnail FROM games_data WHERE id IN (" . implode(',', $games_ids) . ") AND (title LIKE '%$input%')");
                while ($gamesrow = mysqli_fetch_assoc($gamessql)) {
                    echo '<div id="game_card"><img class="test_2 rounded-3 mt-3" width="120px" height="120px" src="images/' . $gamesrow['thumbnail'] . '"></div>';
                }
            }
        }
    }
}
