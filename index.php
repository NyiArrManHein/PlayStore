<?php
include('db.php');
session_start();
$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
if ($pageWasRefreshed) {
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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>store.playstation.com</title>
  <link rel="stylesheet" href="/PlayStore/css/main.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="styles.css">
  <script src="index.js"></script>

  <style>
    .game_cards {
      max-width: 85%;
      margin: 0 auto;
    }

    .btnunseen {
      display: none !important;
    }

    /* @media(max-width:768px) {
      #game_card {
        margin-left: 20px;
      }
    } */

    @media (min-width: 700px) {
      .pagination_ul {
        display: block;
      }
    }
  </style>
</head>

<body class="index_body">
  <?php
  include('nav.php');

  $games_sql = "SELECT id,title,price,thumbnail FROM games_data";
  $query = mysqli_query($conn, $games_sql);
  $games_counts = mysqli_num_rows($query);
  $limit = 24;
  $game_page = ceil($games_counts / $limit);
  $start = 0;
  $current_page = 1;

  $gameslimit_sql = "SELECT id,title,price,thumbnail FROM games_data ORDER BY created_date DESC LIMIT $start,$limit";
  if (!isset($_SESSION["page_id"])) {
    $_SESSION["page_id"] = 1;
  }

  //ClearButton session
  if (isset($_SESSION["sort"])) {
    echo '<script>
            $(document).ready(function() {
                $(".total_counts").addClass("unseen");
                $("#clear_sorting_btn").removeClass("unseen");
                $("#clear_sorting").text("' . $_SESSION['current'] . '");
                $("#clear_sorting_btn").click(function(){
                  $.ajax({
                      url:"clearsortfilter.php",
                      method:"POST",
                      data:{"clearsort":1},
                      success:function(result){
                        $("#games").html(result);
                      }
                  })
                  $("#clear_sorting_btn").addClass("unseen");
                })
          });
          </script>';
  }

  if (isset($_SESSION['filter'])) {
    echo '<script>
            $(document).ready(function() {
                $(".total_counts").addClass("unseen");
                $("#clear_genre_btn").removeClass("unseen");
                $("#clear_genre").text("' . $_SESSION['genre'] . '");
                $("#clear_genre_btn").click(function(){
                  $.ajax({
                      url:"clearsortfilter.php",
                      method:"POST",
                      data:{"clearfilter":1},
                      success:function(result){
                        $("#games").html(result);
                      }
                  })
                  $("#clear_genre_btn").addClass("unseen");
              })
            });
          </script>';
  }



  //GameDetails session for pagination
  if (isset($_SESSION['pagination_sql'])) {
    $gameslimit_sql = $_SESSION['pagination_sql'];
    $current_page = $_SESSION["page_id"];
  }
  //GameDetails session for sorting
  if (isset($_SESSION['sorting_sql'])) {
    $gameslimit_sql = $_SESSION['sorting_sql'];
    $current_page = $_SESSION["page_id"];
  }
  //GameDetails session for filtering
  if (isset($_SESSION['filtering_sql'])) {
    $gameslimit_sql = $_SESSION['filtering_sql'];
    $current_page = $_SESSION["page_id"];
  }
  //GameDetails session for clearsortfilter
  if (isset($_SESSION['clear_sortfilter'])) {
    $gameslimit_sql = $_SESSION['clear_sortfilter'];
    $current_page = 1;
  }

  if (isset($_SESSION['search_sql'])) {
    $gameslimit_sql = $_SESSION['search_sql'];
    $current_page = $_SESSION["page_id"];
  }

  if (isset($_SESSION['search_pagination'])) {
    $gameslimit_sql = $_SESSION['search_pagination'];
    $current_page = $_SESSION["page_id"];
  }

  $gameslimit_query = mysqli_query($conn, $gameslimit_sql);
  ?>
  <!-- ...................GameCards...................... -->
  <div class="game_cards container">


    <!-- <h1 class="my-4">ALL Games</h1> -->
    <div class="d-flex justify-content-center position-sticky top-0 mt-4">
      <input id="search_input" class="form-control" style="max-width: 400px;" type="text" placeholder="Search">
    </div>
    <div class="sort_container d-flex justify-content-between my-4">
      <!-- <p class="total_counts">7586 items</p> -->

      <div>
        <button id="clear_genre_btn" class="btn rounded-2 me-2 unseen" style="background-color: #B6BAC2; padding: 11px;"> <span id="clear_genre"></span><img src="images/xmark.PNG" width="15px" height="15px" alt=""></button>
        <button id="clear_sorting_btn" class="btn rounded-2 unseen" style="background-color: #B6BAC2; padding: 11px;"> <span id="clear_sorting"></span> <img src="images/xmark.PNG" width="15px" height="15px" alt=""></button>
      </div>


      <div class="dropdown">
        <button class="btn dropdown-toggle" type="button" id="sort_dropdown" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
          Sort and Filter
        </button>
        <?php include('dropdown.php'); ?>
      </div>
    </div>

    <div id="games" class="row row-cols-lg-6 row-cols-md-4 row-cols-sm-2">
      <?php
      while ($row = mysqli_fetch_assoc($gameslimit_query)) { ?>
        <a class="text-decoration-none" style="color: inherit;" href="game_details.php?id=<?php echo $row['id']; ?>">
          <div id="game_card" class="test_1">
            <img class="test_2 rounded-3" width="145px" height="145px" src="images/<?php echo $row['thumbnail']; ?>">
            <p><?php echo $row['title']; ?></p>
            <p>&dollar;<?php echo $row['price']; ?></p>
          </div>
        </a>
      <?php } ?>
    </div>
  </div>

  <div class="pagination d-flex justify-content-center align-items-center">
    <ul id="mainPagination" class="pagination_ul">
    </ul>
  </div>


  <script>
    function NoResultFound(isSearch) {
      if (isSearch == 1) {
        $('#games').attr('class', 'row row-cols-lg-6 row-cols-md-4 row-cols-sm-2');
        $('#mainPagination').removeAttr('style');
      } else {
        $('#games').attr('class', 'd-flex justify-content-center align-items-center');
        $('#games').html('<div class="d-flex flex-column"><img src="images/noresultfound.webp" width="289px" height="289px" alt=""><p class="text-center">No results found</p></div>');
        $('#mainPagination').attr('style', 'display:none!important');
      }

    }



    const ulTag = document.querySelector(".pagination_ul");
    let totalPages = <?php if (isset($_SESSION['filtering_page'])) {
                        echo $_SESSION['filtering_page'];
                      } elseif (isset($_SESSION['search_page'])) {
                        echo $_SESSION['search_page'];
                      } else {
                        echo $game_page;
                      } ?>

    function element(totalPages, page) {
      let liTag = '';
      let activeLi;
      let beforePages = page - 1;
      let afterPages = page + 1;


      for (let pageLength = beforePages; pageLength <= afterPages; pageLength++) {
        if (pageLength > totalPages) {
          continue;
        }
        if (pageLength == 0) {
          pageLength = pageLength + 1;
        }

        if (page == pageLength) {
          activeLi = "active";
        } else {
          activeLi = "";
        }
        // liTag += `<li class="numb ${activeLi}" onclick="element(totalPages, ${pageLength})"><a href="index.php?id=${pageLength}"><span>${pageLength}</span></a></li>`
        liTag += `<li id="${pageLength}" class="numb ${activeLi}" onclick="element(totalPages, ${pageLength})"><span>${pageLength}</span></li>`;
      }

      if (page < totalPages - 1) {
        if (page < totalPages - 2) {
          liTag += `<li class="dots"><span>...</span></li>`;
        }
        // liTag += `<li class="numb" onclick="element(totalPages, ${totalPages})"><a href="index.php?id=${totalPages}"><span>${totalPages}</span></a></li>`
        liTag += `<li id="${totalPages}" class="numb" onclick="element(totalPages, ${totalPages})"><span>${totalPages}</span></li>`;
      }


      ulTag.innerHTML = liTag;
      $('li').click(function() {
        let id = $(this).attr('id');
        $.ajax({
          url: "pagination.php",
          method: "GET",
          data: {
            id
          },
          success: function(result) {
            $('#games').html(result);
          }
        })
      })
    }
    element(totalPages, <?php echo $current_page; ?>);

    $("#hamburger_btn,#close_btn").click(function() {
      $('.pagination_ul').toggleClass('unseen');
    })

    $('#search_input').keyup(function() {
      var searchValue = $('#search_input').val().trim();
      $.ajax({
        url: "search.php",
        method: "POST",
        data: {
          searchValue
        },
        success: function(result) {
          $('#games').html(result);
        }
      })

    })
  </script>
</body>

</html>