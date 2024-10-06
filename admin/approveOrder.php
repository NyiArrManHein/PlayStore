<?php
include('../db.php');
if (isset($_POST['approve'])) {
    $id = $_POST['value'];
    $sql = mysqli_query($conn, "UPDATE order_games SET ispurchased='1' WHERE id='$id'");
} elseif (isset($_POST['cancel'])) {
    $id = $_POST['value'];
    $sql = mysqli_query($conn, "UPDATE order_games SET ispurchased='2' WHERE id='$id'");
}
