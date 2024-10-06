<?php
include('../db.php');
session_start();
$start = 0;
$limit = 10;
if (isset($_POST['id'])) {
    $sql = "SELECT id FROM games_data";
    $query = mysqli_query($conn, $sql);
    $counts = mysqli_num_rows($query);
    $game_page = ceil($counts / $limit);
    $id = $_POST['id'];
    $start = ($id - 1) * $limit;
}
if (isset($_SESSION['crudSearch'])) {
    $crudSearch = $_SESSION['crudSearch'];
    $sql = "SELECT id,title,price,thumbnail,console,publisher FROM games_data WHERE title LIKE '%$crudSearch%'";
    $query = mysqli_query($conn, $sql);
    $limit_sql = "SELECT id,title,price,thumbnail,console,publisher FROM games_data WHERE title LIKE '%$crudSearch%' ORDER BY created_date DESC LIMIT $start,$limit";
    $counts = mysqli_num_rows($query);
    $game_page = ceil($counts / $limit);
} else {
    $limit_sql = "SELECT id,title,price,thumbnail,console,publisher FROM games_data ORDER BY created_date DESC LIMIT $start,$limit";
}

$limit_query = mysqli_query($conn, $limit_sql);
echo '<tr><th>photo</th><th>title</th><th>price</th><th>console</th><th>publisher</th><th>Action</th></tr>';
while ($row = mysqli_fetch_assoc($limit_query)) {
    $console = '';
    if ($row['console'] == 0) {
        $console = '<td data-cell="console">PS4</td>';
    } elseif ($row['console'] == 1) {
        $console = '<td data-cell="console">PS5</td>';
    }
    echo '<tr><td data-cell="photo"><img src="../images/' . $row['thumbnail'] . '" width="80px" alt=""></td>
            <td data-cell="title">' . $row['title'] . '</td><td data-cell="price">&dollar;' . $row['price'] . '</td>
            ' . $console . '<td data-cell="publisher">' . $row['publisher'] . '</td><td data-cell="action"><i onclick="edit(' . $row['id'] . ')" class="fa-solid fa-pencil me-3 rounded-circle bg-warning" style="width: 33px; height: 33px; padding: 9px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#add_games_modal"></i>
            <i onclick="destroy(' . $row['id'] . ')" class="fa-solid fa-trash rounded-circle bg-warning" style="width: 33px; height: 33px; padding: 9px; cursor: pointer;"></i></td></tr>';
}
echo '<script>element(' . $game_page . ', ' . $id . ');</script>';
