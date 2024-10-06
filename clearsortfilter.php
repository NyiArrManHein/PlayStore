<?php
include('db.php');
session_start();
$start = 0;
$limit = 24;
if (isset($_POST['clearsort'])) {
    if (isset($_SESSION['filter'])) {
        $filter = $_SESSION['filter'];
        $sql = "SELECT id,title,price,thumbnail FROM games_data WHERE genre = $filter";
        $query = mysqli_query($conn, $sql);
        $counts = mysqli_num_rows($query);
        $page = ceil($counts / $limit);
        $limit_sql = "SELECT id,title,price,thumbnail FROM games_data WHERE genre = $filter ORDER BY created_date DESC LIMIT $start,$limit";
        $clear_sortfilter = $limit_sql;
        unset($_SESSION["sort"]);
    } else {
        $sql = "SELECT id,title,price,thumbnail FROM games_data";
        $query = mysqli_query($conn, $sql);
        $counts = mysqli_num_rows($query);
        $page = ceil($counts / $limit);
        $limit_sql = "SELECT id,title,price,thumbnail FROM games_data ORDER BY created_date DESC LIMIT $start,$limit";
        $clear_sortfilter = $limit_sql;
        unset($_SESSION["sort"]);
    }
} elseif ($_POST['clearfilter']) {
    if (isset($_SESSION["sort"])) {
        $sort = $_SESSION["sort"];
        $sql = "SELECT id,title,price,thumbnail FROM games_data";
        $query = mysqli_query($conn, $sql);
        $counts = mysqli_num_rows($query);
        $page = ceil($counts / $limit);
        $limit_sql = "SELECT id,title,price,thumbnail FROM games_data ORDER BY $sort LIMIT $start,$limit";
        $clear_sortfilter = $limit_sql;
        unset($_SESSION['filter']);
        unset($_SESSION['filtering_page']);
    } else {
        $sql = "SELECT id,title,price,thumbnail FROM games_data";
        $query = mysqli_query($conn, $sql);
        $counts = mysqli_num_rows($query);
        $page = ceil($counts / $limit);
        $limit_sql = "SELECT id,title,price,thumbnail FROM games_data ORDER BY created_date DESC LIMIT $start,$limit";
        $clear_sortfilter = $limit_sql;
        unset($_SESSION['filter']);
        unset($_SESSION['filtering_page']);
    }
}
$limit_query = mysqli_query($conn, $limit_sql);

while ($row = mysqli_fetch_assoc($limit_query)) {
    echo '<a class="text-decoration-none" style="color: inherit;" href="game_details.php?id=' . $row['id'] . '&clear_sortfilter=' . $clear_sortfilter . '">
        <div id="game_card" class="test_1"><img class="test_2 rounded-3" width="145px" height="145px" src="images/' . $row['thumbnail'] . '">
        <p>' . $row['title'] . '</p><p>&dollar;' . $row['price'] . '</p></div></a>';
    echo '<script>element(' . $page . ', 1);</script>';
}
