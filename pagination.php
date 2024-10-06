<?php
include('db.php');
session_start();
$id = 1;
$start = 0;
$limit = 24;
$sql = "SELECT id FROM games_data";
$query = mysqli_query($conn, $sql);
$games_counts = mysqli_num_rows($query);
$game_page = ceil($games_counts / $limit);
$gameslimit_sql = "";


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $start = ($id - 1) * $limit;
    $_SESSION["page_id"] = $id;
}
if (isset($_SESSION['filtering_page'])) {
    $page = $_SESSION['filtering_page'];
} elseif (isset($_SESSION['search_page'])) {
    $page = $_SESSION['search_page'];
} else {
    $page = $game_page;
}
if (isset($_SESSION["sort"]) && isset($_SESSION['filter'])) {
    $sort = $_SESSION["sort"];
    $filter = $_SESSION['filter'];
    $gameslimit_sql = "SELECT id,title,price,thumbnail FROM games_data WHERE genre = $filter ORDER BY $sort LIMIT $start,$limit";
    // $encoded_pagination_sql = htmlspecialchars($gameslimit_sql, ENT_QUOTES, 'UTF-8');
    $pagination_sql = $gameslimit_sql;
} elseif (isset($_SESSION["sort"])) {
    $sort = $_SESSION["sort"];
    $gameslimit_sql = "SELECT id,title,price,thumbnail FROM games_data ORDER BY $sort LIMIT $start,$limit";
    // $encoded_pagination_sql = htmlspecialchars($gameslimit_sql, ENT_QUOTES, 'UTF-8');
    $pagination_sql = $gameslimit_sql;
} elseif (isset($_SESSION['filter'])) {
    $filter = $_SESSION['filter'];
    $gameslimit_sql = "SELECT id,title,price,thumbnail FROM games_data WHERE genre = $filter ORDER BY created_date DESC LIMIT $start,$limit";
    // $encoded_pagination_sql = htmlspecialchars($gameslimit_sql, ENT_QUOTES, 'UTF-8');
    $pagination_sql = $gameslimit_sql;
} elseif (isset($_SESSION['searchValue'])) {
    $searchValue = $_SESSION['searchValue'];
    $gameslimit_sql = "SELECT * FROM games_data WHERE title LIKE '%$searchValue%' ORDER BY created_date DESC LIMIT $start,$limit";
    $pagination_sql = $gameslimit_sql;
} else {
    $gameslimit_sql = "SELECT id,title,price,thumbnail FROM games_data ORDER BY created_date DESC LIMIT $start,$limit";
    // $encoded_pagination_sql = htmlspecialchars($gameslimit_sql, ENT_QUOTES, 'UTF-8');
    $pagination_sql = $gameslimit_sql;
}

$gameslimit_query = mysqli_query($conn, $gameslimit_sql);
while ($row = mysqli_fetch_assoc($gameslimit_query)) {
    echo '<a class="text-decoration-none" style="color: inherit;" href="game_details.php?id=' . $row['id'] . '&pagination=' . $pagination_sql . '">
        <div id="game_card" class="test_1">
        <img class="test_2 rounded-3" width="145px" height="145px" src="images/' . $row['thumbnail'] . '">
        <p>' . $row['title'] . '</p><p>&dollar;' . $row['price'] . '</p></div></a>';
}
echo '<script>element(' . $page . ',' . $id . ' );</script>';
