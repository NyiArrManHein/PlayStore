<?php
include('db.php');
session_start();

if (isset($_SESSION['cart'])) {
    $session_array_id = array_column($_SESSION['cart'], 'id');
}

if (!isset($_GET['id'])) {
    header("location:index.php");
}

if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
} else {
    $userId = null;
}

$numOrders = 0;
if (isset($_SESSION['cart'])) {
    $numOrders = count($_SESSION['cart']);
}

if ($numOrders == 0) {
    unset($_SESSION['cart']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/PlayStore/css/main.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="styles.css">
    <script src="index.js"></script>
    <style>
        body {
            overflow-x: hidden !important;
        }

        #footer {
            max-width: 70%;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <?php
    include("modal.php");
    include('nav.php');
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM games_data WHERE id ='$id'";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);
        $platform = $row['console'];
        $purchases = $row['purchases'];
        $online_status = $row['online_status'];
        $online_players = $row['online_players'];
        $players = $row['players'];
        $genre = $row['genre'];
        $esrb = $row['esrb'];
        $legal = $row['legal_info'];
    }

    if (isset($_GET['pagination'])) {
        $_SESSION['pagination_sql'] = $_GET['pagination'];
        unset($_SESSION['sorting_sql']);
        unset($_SESSION['filtering_sql']);
        unset($_SESSION['clear_sortfilter']);
        unset($_SESSION['search_sql']);
    } elseif (isset($_GET['sorting'])) {
        $_SESSION['sorting_sql'] = $_GET['sorting'];
        unset($_SESSION['pagination_sql']);
        unset($_SESSION['filtering_sql']);
        unset($_SESSION['clear_sortfilter']);
        unset($_SESSION['search_sql']);
    } elseif (isset($_GET['filter'])) {
        $_SESSION['filtering_sql'] = $_GET['filter'];
        unset($_SESSION['pagination_sql']);
        unset($_SESSION['sorting_sql']);
        unset($_SESSION['clear_sortfilter']);
        unset($_SESSION['search_sql']);
    } elseif (isset($_GET['clear_sortfilter'])) {
        $_SESSION['clear_sortfilter'] = $_GET['clear_sortfilter'];
        unset($_SESSION['sorting_sql']);
        unset($_SESSION['filtering_sql']);
        unset($_SESSION['pagination_sql']);
        unset($_SESSION['search_sql']);
    } elseif (isset($_GET['searchsql'])) {
        $_SESSION['search_sql'] = $_GET['searchsql'];
        unset($_SESSION['sorting_sql']);
        unset($_SESSION['filtering_sql']);
        unset($_SESSION['clear_sortfilter']);
        unset($_SESSION['pagination_sql']);
    }


    ?>
    <!-- <img id="poster_img" src="images/650c140ed20e0_modernwarfare_poster.webp" alt=""> -->
    <img id="poster_img" src="images/<?php echo $row['poster']; ?>" alt="">
    <div id="game_details_container" class="d-flex flex-column bg-black">


        <div id="testing" class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div id="grey_div" class="p-5">
                        <h1 id="details_header" class="text-white" style="margin-bottom: 20px;">
                            <?php echo $row['title']; ?></h1>
                        <p id="details_publisher" class="text-white" style="font-size: 12px;">
                            <?php echo $row['publisher']; ?></p>
                        <?php if ($platform == 0) { ?>
                            <p id="details_console" class="text-white" style="font-size: 12px;">PS4</p>
                        <?php } else if ($platform == 1) { ?>
                            <p id="details_console" class="text-white" style="font-size: 12px;">PS5</p>
                        <?php } ?>
                        <p id="details_price" style="font-size: 23px; margin-top: 20px;" class="text-white">
                            &dollar;<?php echo $row['price']; ?></p>


                        <input id="detailsId" type="hidden" name="detailsId" value="<?php echo $id; ?>">
                        <input id="iThumbnail" type="hidden" name="iThumbnail" value="<?php echo $row['thumbnail']; ?>">
                        <input id="iPrice" type="hidden" name="iPrice" value="<?php echo $row['price']; ?>">
                        <input id="iDate" type="hidden" name="iDate" value="<?php echo $row['created_date']; ?>">
                        <input id="iOnlineStatus" type="hidden" name="iOnlineStatus" value="<?php echo $online_status; ?>">
                        <input id="iPurchases" type="hidden" name="iPurchases" value="<?php echo $purchases; ?>">
                        <input id="iOnlinePlayers" type="hidden" name="iOnlinePlayers" value="<?php echo $online_players; ?>">
                        <input id="iPlayers" type="hidden" name="iPlayers" value="<?php echo $players; ?>">
                        <input id="iEsrb" type="hidden" name="iEsrb" value="<?php echo $esrb; ?>">
                        <input id="iLegal" type="hidden" name="iLegal" value="<?php echo $legal; ?>">


                        <?php
                        $alreadyPurchased = false;
                        $checksql =  mysqli_query($conn, "SELECT games_id,ispurchased FROM order_games WHERE user_id='$userId' AND ispurchased IN ('1','0')");
                        while ($checkrow = mysqli_fetch_assoc($checksql)) {
                            $gamesId = json_decode($checkrow['games_id']);
                            foreach ($gamesId as $gameId) {
                                if ($gameId == $id) {
                                    $alreadyPurchased = true;
                                }
                            }
                        }
                        if ($alreadyPurchased === true) { ?>
                            <button style="width: 85%; background-color: #f84c08;" class="btn rounded-pill text-white">Already Purchased</button>
                        <?php } else { ?>
                            <div class="d-flex">
                                <button id="add_to_cart_btn" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="added to cart" class="btn rounded-pill text-white">Add to Cart</button>
                                <img width="44px" id="wishBtn" style="cursor: pointer;" src="images/wishlist1.png" alt="">
                                <img id="wishFillBtn" style="cursor: pointer;" height="43px" class="unseen" src="images/wishlistFill.png" alt="">
                            </div>
                        <?php } ?>



                        <div id="text_test"></div>

                    </div>
                </div>
                <div class="second_div_container col-md-4 ps-5 pt-4">
                    <div class="second_div d-flex justify-content-between">
                        <div>
                            <ul>
                                <p id="numOrders"></p>
                                <?php if ($online_status == 1 || $online_status == 2) { ?>
                                    <div id="ps_plus">
                                        <img src="images/ps_plus.png" alt="">
                                        <span style="font-size: 14px;" class="text-white ms-2">PS Plus required for online play</span>
                                    </div>
                                <?php } ?>

                                <?php if ($purchases == 1) { ?>
                                    <div id="ingame_purchases">
                                        <img src="images/purchases.png" alt="">
                                        <span style="font-size: 14px;" class="text-white ms-2">In-game purchases optional</span>
                                    </div>
                                <?php } ?>

                                <?php if ($online_players != 0) { ?>
                                    <div id="support_players">
                                        <img src="images/support_players.png" alt="">
                                        <span style="font-size: 14px;" class="text-white ms-2">Supports up to <span><?php echo $online_players; ?></span> online players with PS Plus</span>
                                    </div>
                                <?php } ?>


                                <div>
                                    <img src="images/online_play.png" alt="">
                                    <?php if ($online_status == 1) { ?>
                                        <span id="online_play_required" style="font-size: 14px;" class="text-white ms-2">Online play required</span>
                                    <?php } elseif ($online_status == 2) { ?>
                                        <span id="online_play_optional" style="font-size: 14px;" class="text-white ms-2">Online play optional</span>
                                    <?php } elseif ($online_status == 3) { ?>
                                        <span id="offline_play_enabled" style="font-size: 14px;" class="text-white ms-2">Offline play enabled</span>
                                    <?php } ?>
                                </div>

                                <?php if ($players == 0 || $players == 1) { ?>
                                    <div id="player_1">
                                        <img src="images/player_1.png" alt="">
                                        <span style="font-size: 14px;" class="text-white ms-2">1 player</span>
                                    </div>
                                <?php } else { ?>
                                    <div>
                                        <img src="images/players.png" alt="">
                                        <span style="font-size: 14px;" class="text-white ms-2">1 - <span id="players_count"><?php echo $players; ?></span> players</span>
                                    </div>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>

                    <!-- ...........................StartHiddenInputs......................... -->

                    <!-- ...........................EndHiddenInputs......................... -->
                </div>
                <div class="third_div col-md-4 col-sm-12 pt-4">
                    <?php if ($esrb == 1) { ?>
                        <div id="everyone" class="d-flex align-items-start">
                            <img style="margin-right: 20px;" id="esrb_img" src="images/e.png" width="48px" height="72px" alt="">
                            <p style="font-size: 14px; width: 250px;" class="d-inline-block text-white">Content is generally suitable for all ages</p>
                        </div>
                    <?php } elseif ($esrb == 2) { ?>
                        <div id="everyone_tenplus" class="d-flex align-items-start">
                            <img style="margin-right: 20px;" id="esrb_img" src="images/e10.png" width="48px" height="72px" alt="">
                            <p style="font-size: 14px; width: 250px;" class="d-inline-block text-white">Content is generally suitable for ages 10 and up</p>
                        </div>
                    <?php } elseif ($esrb == 3) { ?>
                        <div id="teen" class="d-flex align-items-start">
                            <img style="margin-right: 20px;" id="esrb_img" src="images/t.png" width="48px" height="72px" alt="">
                            <p style="font-size: 14px; width: 250px;" class="d-inline-block text-white">Content is generally suitable for ages 13 and up</p>
                        </div>
                    <?php } elseif ($esrb == 4) { ?>
                        <div id="mature" class="d-flex align-items-start">
                            <img style="margin-right: 20px;" id="esrb_img" src="images/M.svg" width="48px" height="72px" alt="">
                            <p style="font-size: 14px; width: 250px;" class="d-inline-block text-white">Content is generally suitable for ages 17 and up</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>


        <!-- .............Second List............. -->
        <div style="margin: 0;" id="second_list" class="d-flex justify-content-evenly">
            <div>
                <?php if ($online_status == 1 || $online_status == 2) { ?>
                    <div id="ps_plus">
                        <img src="images/ps_plus.png" alt="">
                        <span style="font-size: 12px;" class="text-white ms-2">PS Plus required for online play</span>
                    </div>
                <?php } ?>

                <?php if ($purchases == 1) { ?>
                    <div id="ingame_purchases">
                        <img src="images/purchases.png" alt="">
                        <span style="font-size: 12px;" class="text-white ms-2">In-game purchases optional</span>
                    </div>
                <?php } ?>
            </div>

            <div>
                <?php if ($online_players != 0) { ?>
                    <div id="support_players">
                        <img src="images/support_players.png" alt="">
                        <span style="font-size: 12px;" class="text-white ms-2">Supports up to <span><?php echo $online_players; ?></span> online players with PS Plus</span>
                    </div>
                <?php } ?>

                <div>
                    <img src="images/online_play.png" alt="">
                    <?php if ($online_status == 1) { ?>
                        <span id="online_play_required" style="font-size: 12px;" class="text-white ms-2">Online play required</span>
                    <?php } elseif ($online_status == 2) { ?>
                        <span id="online_play_optional" style="font-size: 12px;" class="text-white ms-2">Online play optional</span>
                    <?php } elseif ($online_status == 3) { ?>
                        <span id="offline_play_enabled" style="font-size: 12px;" class="text-white ms-2">Offline play enabled</span>
                    <?php } ?>
                </div>
            </div>

            <div>
                <?php if ($players == 0 || $players == 1) { ?>
                    <div id="player_1">
                        <img src="images/player_1.png" alt="">
                        <span style="font-size: 12px;" class="text-white ms-2">1 player</span>
                    </div>
                <?php } else { ?>
                    <div>
                        <img src="images/players.png" alt="">
                        <span style="font-size: 12px;" class="text-white ms-2">1 - <span id="players_count"><?php echo $players; ?></span> players</span>
                    </div>
                <?php } ?>
            </div>
        </div>

        <h2 class="text-center text-white my-5">Game and Legal Info</h2>
        <div id="legal_info" class="p-4 mb-5">
            <p id="legal_info_txt" class="text-white"><?php echo $row['legal_info']; ?></p>
        </div>


        <!-- <div id="footer_container" class="d-flex justify-content-around">
                <div class="container">
                    <div class="row">
                        <div id="footer_fir_div" class="col-md-6 col-sm-12">
                            <div id="prpg_info" class="d-flex justify-content-evenly">
                                <div class="d-flex flex-column justify-content-between">
                                    <p class="text-white">Platform:</p>
                                    <p class="text-white">Release:</p>
                                    <p class="text-white">Publisher:</p>
                                    <p class="text-white">Genre:</p>
                                </div>
                                <div class="d-flex flex-column justify-content-between">
                                    <?php if ($platform == 0) { ?>
                                        <p class="text-white">PS4</p>
                                    <?php } elseif ($platform == 1) { ?>
                                        <p class="text-white">PS5</p>
                                    <?php } ?>
                                    <p id="details_date" class="text-white"><?php echo $row['created_date']; ?></p>
                                    <p class="text-white"><?php echo $row['publisher']; ?></p>
                                    <?php switch ($genre) {
                                        case 1: ?>
                                            <p class="text-white">Action</p>
                                        <?php break;
                                        case 2: ?>
                                            <p class="text-white">Adventure</p>
                                        <?php break;
                                        case 3: ?>
                                            <p class="text-white">Arcade</p>
                                        <?php break;
                                        case 4: ?>
                                            <p class="text-white">Shooter</p>
                                        <?php break;
                                        case 5: ?>
                                            <p class="text-white">Role Playing Games</p>
                                        <?php break;
                                        case 6: ?>
                                            <p class="text-white">Puzzle</p>
                                        <?php break;
                                        case 7: ?>
                                            <p class="text-white">Casual</p>
                                        <?php break;
                                        case 8: ?>
                                            <p class="text-white">Simulation</p>
                                        <?php break;
                                        case 9: ?>
                                            <p class="text-white">Strategy</p>
                                        <?php break;
                                        case 10: ?>
                                            <p class="text-white">Sport</p>
                                        <?php break;
                                        case 11: ?>
                                            <p class="text-white">Driving/Racing</p>
                                        <?php break;
                                        case 12: ?>
                                            <p class="text-white">Horror</p>
                                        <?php break;
                                        case 13: ?>
                                            <p class="text-white">Fighting</p>
                                        <?php break;
                                        case 14: ?>
                                            <p class="text-white">Simulator</p>
                                    <?php break;
                                    } ?>
                                </div>
                            </div>
                        </div>
                        <div id="footer_sec_div" class="col-md-6 col-sm-12">
                            <p id="footer_txt" class="text-white"><?php echo $row['footer']; ?></p>
                        </div>
    
                    </div>
                </div>
            </div> -->

        <!-- ..............TetingFooter............... -->

        <div id="footer">
            <div class="container">
                <div class="row">
                    <div class="d-flex flex-column col-md-6 col-sm-12 mb-5">
                        <?php
                        $spanConsole = null;
                        $spanGenre = null;
                        if ($platform == 0) {
                            $spanConsole = 'PS4';
                        } elseif ($platform == 1) {
                            $spanConsole = 'PS5';
                        }

                        switch ($genre) {
                            case 1:
                                $spanGenre = 'Action';
                                break;
                            case 2:
                                $spanGenre = 'Adventure';
                                break;
                            case 3:
                                $spanGenre = 'Arcade';
                                break;
                            case 4:
                                $spanGenre = 'Shooter';
                                break;
                            case 5:
                                $spanGenre = 'Role Playing Games';
                                break;
                            case 6:
                                $spanGenre = 'Puzzle';
                                break;
                            case 7:
                                $spanGenre = 'Casual';
                                break;
                            case 8:
                                $spanGenre = 'Simulation';
                                break;
                            case 9:
                                $spanGenre = 'Strategy';
                                break;
                            case 10:
                                $spanGenre = 'Sport';
                                break;
                            case 11:
                                $spanGenre = 'Driving/Racing';
                                break;
                            case 12:
                                $spanGenre = 'Horror';
                                break;
                            case 13:
                                $spanGenre = 'Fighting';
                                break;
                            case 14:
                                $spanGenre = 'Simulator';
                                break;
                        }
                        ?>
                        <span class="text-white mb-1">Platform:&nbsp;&nbsp;&nbsp;<?php echo $spanConsole; ?></span>
                        <span class="text-white mb-1">Release:&nbsp;&nbsp;&nbsp;<?php echo $row['created_date']; ?></span>
                        <span class="text-white mb-1">Publisher:&nbsp;&nbsp;&nbsp;<?php echo $row['publisher']; ?></span>
                        <span class="text-white mb-1">Genre:&nbsp;&nbsp;&nbsp;<?php echo $spanGenre; ?></span>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <span id="footer_txt" class="text-white"><?php echo $row['footer']; ?></span>
                    </div>
                </div>

            </div>
        </div>





        <!-- ...................EndFooter.................. -->


    </div>
    <script>
        $(document).ready(function() {
            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
            const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));

            $('[data-bs-toggle="popover"]').popover({
                delay: {
                    "show": 500,
                    "hide": 100
                }
            });

            $('[data-bs-toggle="popover"]').click(function() {

                setTimeout(function() {
                    $('.popover').fadeOut('slow');
                }, 1000);

            });

            $('#add_to_cart_btn').click(function() {
                <?php if (isset($_SESSION['id'])) { ?>
                    var gameId = $('#detailsId').val();
                    var iThumbnail = $('#iThumbnail').val();
                    var iTitle = $('#details_header').text();
                    var iPrice = $('#iPrice').val();
                    var iDate = $('#iDate').val();
                    var iOnlineStatus = $('#iOnlineStatus').val();
                    var iPurchases = $('#iPurchases').val();
                    var iOnlinePlayers = $('#iOnlinePlayers').val();
                    var iPlayers = $('#iPlayers').val();
                    var iEsrb = $('#iEsrb').val();
                    var iLegal = $('#legal_info_txt').text();

                    $.ajax({
                        url: "addToCart.php",
                        method: "POST",
                        data: {
                            iThumbnail,
                            iTitle,
                            iPrice,
                            iDate,
                            gameId,
                            iOnlineStatus,
                            iPurchases,
                            iOnlinePlayers,
                            iPlayers,
                            iEsrb,
                            iLegal
                        },
                        success: function(result) {
                            $('#numOrders').html(result);
                        }

                    })
                <?php } else { ?>
                    window.location.href = 'auth/login.php';
                <?php } ?>
            })

            <?php
            if (isset($_SESSION['cart'])) {
                if (!in_array($id, $session_array_id)) { ?>
                    $('#add_to_cart_btn').text('Add to Cart');
                <?php } else { ?>
                    $('#add_to_cart_btn').text('Already In Cart');
            <?php }
            } ?>

            $('#wishBtn,#wishFillBtn').click(function() {
                var btnId = $(this).attr('id');
                var wishlistId = $('#detailsId').val();
                var requestData = {};
                if (btnId === 'wishFillBtn') {
                    requestData = {
                        'wishfill': 1,
                        'value': wishlistId
                    };
                } else if (btnId === 'wishBtn') {
                    requestData = {
                        'wish': 1,
                        'value': wishlistId
                    };
                }
                $('#wishBtn,#wishFillBtn').toggleClass('unseen');
                $.ajax({
                    url: 'wish.php',
                    method: 'POST',
                    data: requestData,
                    success: function(result) {

                    }

                })
            })

            <?php $wishcheckSql = mysqli_query($conn, "SELECT userid,gameid FROM wishlist WHERE userid='$userId' AND gameid='$id'");
            if (mysqli_num_rows($wishcheckSql) > 0) { ?>
                $('#wishBtn').addClass('unseen');
                $('#wishFillBtn').removeClass('unseen');
            <?php } else { ?>
                $('#wishBtn').removeClass('unseen');
                $('#wishFillBtn').addClass('unseen');
            <?php } ?>
        })
    </script>
</body>

</html>