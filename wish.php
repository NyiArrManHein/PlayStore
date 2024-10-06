<?php
include('db.php');
session_start();
$userId = null;
$gameArray = [];

if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
}

$arraysql = mysqli_query($conn, "SELECT id,userid,gameid FROM wishlist WHERE wishlist.userid='$userId'");
while ($gamerow = mysqli_fetch_assoc($arraysql)) {
    $gameArray[] = $gamerow['gameid'];
}

$checksql = mysqli_query($conn, "SELECT games_id,ispurchased FROM order_games WHERE user_id='$userId' AND ispurchased = '1'");
while ($checkrow = mysqli_fetch_assoc($checksql)) {
    $gamesId = json_decode($checkrow['games_id']);
    foreach ($gamesId as $gameId) {
        if (in_array($gameId, $gameArray)) {
            $deletesql = mysqli_query($conn, "DELETE FROM wishlist WHERE gameid='$gameId' AND userid='$userId'");
        }
    }
}
if (isset($_POST['wish'])) {
    $wishlistId = $_POST['value'];
    $sql = mysqli_query($conn, "INSERT INTO wishlist(userid,gameid) VALUES ('$userId','$wishlistId') ");
}

if (isset($_POST['wishfill'])) {
    $wishlistId = $_POST['value'];
    $sql = mysqli_query($conn, "DELETE FROM wishlist WHERE gameid='$wishlistId' AND userid='$userId'");
}

if (isset($_POST['select'])) {
    $fetchsql = mysqli_query($conn, "SELECT wishlist.id,wishlist.userid,wishlist.gameid,games_data.thumbnail,games_data.title,games_data.console,
    games_data.price FROM wishlist INNER JOIN games_data ON wishlist.gameid=games_data.id WHERE wishlist.userid='$userId'");
    while ($row = mysqli_fetch_assoc($fetchsql)) {
        if ($row['console'] == 0) {
            $platform = '<span class="mb-1">PS4</span>';
        } elseif ($row['console'] == 1) {
            $platform = '<span class="mb-1">PS5</span>';
        }
        echo '<div class="d-flex w-100 my-3" id="wishContainer"><div class="bg-white flex-grow-1"><a class="text-decoration-none" style="color: inherit;" href="game_details.php?id=' . $row['gameid'] . '
             "><div class="d-flex rounded mb-3 mx-0"><img class="rounded-start" src="images/' . $row['thumbnail'] . '"width="108px" height="auto" alt=""><div class="d-flex flex-column p-2"><span class="mb-1">' . $row['title'] .
            '</span>' . $platform . '<span class="mb-1">&dollar;' . $row['price'] . '</span></div></div></a></div> <div style="cursor: pointer; background-color: white;" class="deleteContainer d-flex align-items-center pe-3">
            <i class="wishDelete fa-solid fa-trash"></i><input class="wishid" type="hidden" value="' . $row['gameid'] . '"></div></div>';
    }
}



if (isset($_POST['delete'])) {
    $platform = '';
    $deleteId = $_POST['value'];
    $deletesql = mysqli_query($conn, "DELETE FROM wishlist WHERE gameid='$deleteId' AND userid='$userId'");
}
