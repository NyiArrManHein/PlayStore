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

if (isset($_POST['current'])) {
    $current = $_POST['current'];
    $_SESSION['current'] = $current;
    $name = "";
    $genre = "";
    $order = "";
    $sort = "";
    $value = 0;
    $condition = 0;
    $start = 0;
    $limit = 24;
    $_SESSION["page_id"] = 1;


    if ($current == "a_z") {
        $sort = "title ASC";
        $_SESSION["sort"] = $sort;
    } elseif ($current == "z_a") {
        $sort = "title DESC";
        $_SESSION["sort"] = $sort;
    } elseif ($current == "Old_New") {
        $sort = "created_date ASC";
        $_SESSION["sort"] = $sort;
    } elseif ($current == "New_Old") {
        $sort = "created_date DESC";
        $_SESSION["sort"] = $sort;
    } elseif ($current == "Low_High") {
        $sort = "price ASC";
        $_SESSION["sort"] = $sort;
    } elseif ($current == "High_Low") {
        $sort = "price DESC";
        $_SESSION["sort"] = $sort;
    }

    // if(isset($_SESSION["page_id"])){
    //         $page_id = $_SESSION["page_id"];
    //         $start = ($page_id-1)*$limit; 
    //     }
    if (isset($_SESSION['filter'])) {
        $start = 0;
        $filter = $_SESSION['filter'];
        $sql = "SELECT id,title,price,thumbnail FROM games_data WHERE genre = $filter";
        $query = mysqli_query($conn, $sql);
        $limit_sql = "SELECT id,title,price,thumbnail FROM games_data WHERE genre = $filter ORDER BY $sort LIMIT $start,$limit";
        // $encoded_sorting_sql = htmlspecialchars($limit_sql, ENT_QUOTES, 'UTF-8');
        $sorting_sql = $limit_sql;
        $limit_query = mysqli_query($conn, $limit_sql);
        $counts = mysqli_num_rows($query);
        $page = ceil($counts / $limit);
        $page_id = 1;
    } else {
        $sql = "SELECT id,title,price,thumbnail FROM games_data";
        $query = mysqli_query($conn, $sql);
        $counts = mysqli_num_rows($query);
        $page = ceil($counts / $limit);
        $limit_sql = "SELECT id,title,price,thumbnail FROM games_data ORDER BY $sort LIMIT $start,$limit";
        // $encoded_sorting_sql = htmlspecialchars($limit_sql, ENT_QUOTES, 'UTF-8');
        $sorting_sql = $limit_sql;
        $limit_query = mysqli_query($conn, $limit_sql);
    }

    while ($row = mysqli_fetch_assoc($limit_query)) {
        echo '<a class="text-decoration-none" style="color: inherit;" href="game_details.php?id=' . $row['id'] . '&sorting=' . $sorting_sql . '">
            <div id="game_card" class="test_1"><img class="test_2 rounded-3" width="145px" height="145px" src="images/' . $row['thumbnail'] . '">
            <p>' . $row['title'] . '</p><p>&dollar;' . $row['price'] . '</p></div></a>';
        echo '<script>element(' . $page . ', 1);$("#clear_sorting_btn").show();</script>';
    }
}


?>
<script>
    $('.total_counts').addClass('unseen');
    $('#clear_sorting_btn').removeClass('unseen');
    $('#clear_sorting').text('<?php echo $current; ?>');

    $('#clear_sorting_btn').click(function() {
        $.ajax({
            url: "clearsortfilter.php",
            method: "POST",
            data: {
                "clearsort": 1
            },
            success: function(result) {
                $('#games').html(result);
            }
        })

        $('#clear_sorting_btn').hide();

    })
</script>