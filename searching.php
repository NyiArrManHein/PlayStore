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
  $_SESSION['clear_sortfilter']
);
$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
if (!isset($_GET['coming_from_index'])) {
  header("location:index.php");
}

// if ($_GET['coming_from_index'] || $pageWasRefreshed) {
//   unset(
//     $_SESSION['searchValue'],
//     $_SESSION['search_sql'],
//     $_SESSION['search_pagination'],
//     $_SESSION['searchpage_id']
//   );
// }

if ($pageWasRefreshed) {
  unset(
    $_SESSION['searchValue'],
    $_SESSION['search_sql'],
    $_SESSION['search_pagination'],
    $_SESSION['searchpage_id']
  );
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="/PlayStore/css/main.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="styles.css">
  <script src="index.js"></script>

  <style>
    .searchgame_cards {
      max-width: 85%;
      margin: 0 auto;
    }

    /* @media(max-width:768px) {
      #game_card {
        margin-left: 20px;
      }
    } */
  </style>
</head>

<body class="vh-100">
  <p class="h5 text-white bg-dark text-end p-2 header1">SONY</p>
  <div class="d-flex justify-content-center position-sticky top-0 mt-4">
    <input id="search_input" class="form-control" style="max-width: 400px;" type="text" placeholder="Search">
  </div>

  <div class="searchgame_cards container">


    <h1 class="my-4">ALL Games</h1>

    <!-- <div class="sort_container d-flex justify-content-between my-4">
      <p class="total_counts">7586 itmes</p>
    </div> -->

    <?php
    $start = 0;
    $limit = 24;
    $sql = "SELECT id,title,price,thumbnail FROM games_data";
    $query = mysqli_query($conn, $sql);
    $counts = mysqli_num_rows($query);
    $totalpage = ceil($counts / $limit);
    $current_page = 1;



    if (isset($_SESSION['search_sql'])) {
      $limit_sql = $_SESSION['search_sql'];
    } elseif (isset($_SESSION['search_pagination'])) {
      $limit_sql = $_SESSION['search_pagination'];
    } else {
      $limit_sql = "SELECT id,title,price,thumbnail FROM games_data ORDER BY title ASC LIMIT $start,$limit";
    }

    // if (isset($_SESSION['search_sql'])) {
    //   $limit_sql = $_SESSION['search_sql'];
    //   $current_page = $_SESSION['searchpage_id'];
    // } elseif (isset($_SESSION['search_pagination'])) {
    //   $limit_sql = $_SESSION['search_pagination'];
    //   $current_page = $_SESSION['searchpage_id'];
    // } else {
    //   $limit_sql = "SELECT id,title,price,thumbnail FROM games_data ORDER BY title ASC LIMIT $start,$limit";
    //   $current_page = 1;
    // }


    $limit_query = mysqli_query($conn, $limit_sql);

    ?>
    <div id="search_games" class="row row-cols-lg-6 row-cols-md-4 row-cols-sm-2">
      <?php
      while ($row = mysqli_fetch_assoc($limit_query)) { ?>
        <a class="text-decoration-none" style="color: inherit;" href="game_details.php?id=<?php echo $row['id']; ?>&searchsql=<?php echo $limit_sql;  ?>">
          <div id="game_card" class="test_1">
            <img class="test_2 rounded-3" width="145px" height="145px" src="images/<?php echo $row['thumbnail']; ?>">
            <p><?php echo $row['title']; ?></p>
            <p>&dollar;<?php echo $row['price']; ?></p>
          </div>
        </a>
      <?php } ?>
    </div>


  </div>


  <div id="searchPagination" class="pagination d-flex justify-content-center align-items-center">
    <ul class="pagination_ul">
    </ul>
  </div>


  <script>
    $('#search_input').keyup(function() {
      var searchValue = $('#search_input').val().trim();
      $.ajax({
        url: "search.php",
        method: "POST",
        data: {
          searchValue
        },
        success: function(result) {
          $('#search_games').html(result);
        }
      })

    })

    const ulTag = document.querySelector(".pagination_ul");
    let totalPages = <?php echo $totalpage; ?>



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
      if (page == 0 && totalPages == 0) {
        ulTag.innerHTML = '';
      } else {
        ulTag.innerHTML = liTag;
      }


      $('li').click(function() {
        let id = $(this).attr('id');
        $.ajax({
          url: "search_pagination.php",
          method: "POST",
          data: {
            id
          },
          success: function(result) {
            $('#search_games').html(result);
          }
        })
      })
    }
    element(totalPages, <?php echo $current_page; ?>);

    function NoResultFound(isSearch) {
      if (isSearch == 1) {
        $('#search_games').attr('class', 'row row-cols-lg-6 row-cols-md-4 row-cols-sm-2');
        $('#searchPagination').removeAttr('style');
      } else {
        $('#search_games').attr('class', 'd-flex justify-content-center align-items-center');
        $('#search_games').html('<div class="d-flex flex-column"><img src="images/noresultfound.webp" width="289px" height="289px" alt=""><p class="text-center">No results found</p></div>');
        $('#searchPagination').attr('style', 'display:none!important');
      }

    }
  </script>
</body>

</html>