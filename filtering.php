<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<?php
include('db.php');
session_start();
unset(
    $_SESSION['search_sql'],
    $_SESSION['search_pagination'],
    $_SESSION['searchValue'],
    $_SESSION['search_page']
);
$_SESSION["page_id"] = 1;
if (isset($_POST['genre'])) {
    $genre = $_POST['genre'];
    $_SESSION['genre'] = $genre;
    if ($genre == "Action") {
        $filter = 1;
        $_SESSION['filter'] = $filter;
    } elseif ($genre == "Shooter") {
        $filter = 4;
        $_SESSION['filter'] = $filter;
    } elseif ($genre == "RPG") {
        $filter = 5;
        $_SESSION['filter'] = $filter;
    } elseif ($genre == "Sport") {
        $filter = 10;
        $_SESSION['filter'] = $filter;
    } elseif ($genre == "Racing") {
        $filter = 11;
        $_SESSION['filter'] = $filter;
    } elseif ($genre == "Horror") {
        $filter = 12;
        $_SESSION['filter'] = $filter;
    } elseif ($genre == "Fighting") {
        $filter = 13;
        $_SESSION['filter'] = $filter;
    }

    $f_start = 0;
    $f_limit = 24;
    $sql = "SELECT id,title,price,thumbnail FROM games_data WHERE genre = $filter";
    $query = mysqli_query($conn, $sql);
    $counts = mysqli_num_rows($query);
    $page = ceil($counts / $f_limit);
    $_SESSION['filtering_page'] = $page;

    if (isset($_SESSION["sort"])) {
        $sort = $_SESSION["sort"];
        $limit_sql = "SELECT id,title,price,thumbnail FROM games_data WHERE genre = $filter ORDER BY $sort LIMIT $f_start,$f_limit";
        // $encoded_filtering_sql = htmlspecialchars($limit_sql, ENT_QUOTES, 'UTF-8');
        $filtering_sql = $limit_sql;
        $limit_query = mysqli_query($conn, $limit_sql);
    } else {
        $limit_sql = "SELECT id,title,price,thumbnail FROM games_data WHERE genre = $filter ORDER BY created_date DESC LIMIT $f_start,$f_limit";
        // $encoded_filtering_sql = htmlspecialchars($limit_sql, ENT_QUOTES, 'UTF-8');
        $filtering_sql = $limit_sql;
        $limit_query = mysqli_query($conn, $limit_sql);
    }

    while ($row = mysqli_fetch_assoc($limit_query)) {
        echo '<a class="text-decoration-none" style="color: inherit;" href="game_details.php?id=' . $row['id'] . '&filter=' . $filtering_sql . '">
            <div id="game_card" class="test_1"><img class="test_2 rounded-3" width="145px" height="145px" src="images/' . $row['thumbnail'] . '">
            <p>' . $row['title'] . '</p><p>&dollar;' . $row['price'] . '</p></div></a>';
    }
    echo '<script>element(' . $page . ', 1);$("#clear_genre_btn").show();</script>';
}
?>
<script>
    $('.total_counts').addClass('unseen');
    $('#clear_genre_btn').removeClass('unseen');
    $('#clear_genre').text('<?php echo $genre; ?>');

    $('#clear_genre_btn').click(function() {
        $.ajax({
            url: "clearsortfilter.php",
            method: "POST",
            data: {
                "clearfilter": 1
            },
            success: function(result) {
                $('#games').html(result);
            }
        })

        $('#clear_genre_btn').hide();
    })
</script>