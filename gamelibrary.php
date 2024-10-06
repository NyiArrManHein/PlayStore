<?php
include('db.php');
session_start();
unset(
    $_SESSION["sort"],
    $_SESSION['filter'],
    $_SESSION['current'],
    $_SESSION["page_id"],
    $_SESSION['genre'],
    $_SESSION['filtering_page'],
    $_SESSION['pagination_sql'],
    $_SESSION['sorting_sql'],
    $_SESSION['filtering_sql'],
    $_SESSION['clear_sortfilter'],
    $_SESSION['searchValue'],
    $_SESSION['search_sql'],
    $_SESSION['search_pagination'],
    $_SESSION['search_page']
);
$userId = null;
$totalGames = 0;
if (!isset($_GET['library'])) {
    header("location:index.php");
}

if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
}

$ordersql = mysqli_query($conn, "SELECT games_id,ispurchased FROM order_games WHERE user_id='$userId'");
$gameCountsql = mysqli_query($conn, "SELECT total_items,ispurchased FROM order_games WHERE user_id='$userId'");
while ($countrow = mysqli_fetch_assoc($gameCountsql)) {
    if ($countrow['ispurchased'] == 1) {
        $totalGames += $countrow['total_items'];
    }
}
?>
<style>
    body {
        overflow-x: hidden;
    }

    #gameLibraryBody {
        background-color: black;
    }

    .box {
        max-width: 500px;
        height: 50px;
        background-color: black;
        border-radius: 30px;
        display: flex;
        align-items: center;
        padding: 20px;
    }

    .box>input {
        flex: 1;
        height: 40px;
        border: none;
        outline: none;
        font-size: 18px;
        padding-left: 10px;
    }

    #libraryCards {
        max-width: 70%;
        margin: 0 auto;
    }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/PlayStore/css/main.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src=" https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body id="gameLibraryBody">
    <div id="libraryCards">
        <div class="box">
            <img width="20px" src="images/search_icon1.png" alt="">
            <input id="librarySearch" class="bg-black text-white" type="text" placeholder="Search">
        </div>

        <h5 class="text-white">GAMES ( <span class="text-white" id="gameCount"><?php echo $totalGames; ?></span> )</h5>
        <div id="games" class="row row-cols-lg-6 row-cols-md-4 row-cols-sm-2">
            <?php while ($orderrow = mysqli_fetch_assoc($ordersql)) {
                if ($orderrow['ispurchased'] == 1) {
                    $games_ids = json_decode($orderrow['games_id']);
                    $gamessql = mysqli_query($conn, "SELECT thumbnail FROM games_data WHERE id IN (" . implode(',', $games_ids) . ")");
                    while ($gamesrow = mysqli_fetch_assoc($gamessql)) { ?>
                        <div id="game_card"><img class="test_2 rounded-3 my-3" width="120px" height="120px" src="images/<?php echo $gamesrow['thumbnail']; ?>"></div>
            <?php }
                }
            } ?>
        </div>
    </div>
</body>

</html>
<script>
    $(document).ready(function() {

        $('#librarySearch').keyup(function() {
            var input = $(this).val();
            $.ajax({
                url: "librarySearch.php",
                method: "POST",
                data: {
                    input: input
                },
                success: function(result) {
                    $('#games').html(result);
                }
            })
        })
    })
</script>