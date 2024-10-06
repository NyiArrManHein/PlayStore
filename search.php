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
$start = 0;
$limit = 24;
if (isset($_POST['searchValue'])) {
    $searchValue = $_POST['searchValue'];
    if ($searchValue == "") {
        unset(
            $_SESSION['search_sql'],
            $_SESSION['search_pagination'],
            $_SESSION['searchValue'],
            $_SESSION['search_page']
        );
    }
    $_SESSION['searchValue'] = $searchValue;
    $sql = "SELECT * FROM games_data WHERE title LIKE '%$searchValue%'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        if (mysqli_num_rows($query) > 0) {
            $search_sql = "SELECT * FROM games_data WHERE title LIKE '%$searchValue%' ORDER BY created_date DESC LIMIT $start,$limit";
            $search_query = mysqli_query($conn, $search_sql);
            $counts = mysqli_num_rows($query);
            $page = ceil($counts / $limit);
            $_SESSION['search_page'] = $page;
            while ($row = mysqli_fetch_assoc($search_query)) {
                echo '<script>NoResultFound(1);</script>';
                echo '<a class="text-decoration-none" style="color: inherit;" href="game_details.php?id=' . $row['id'] . '&searchsql=' . $search_sql . '">
                <div id="game_card" class="test_1"><img class="test_2 rounded-3" width="145px" height="145px" src="images/' . $row['thumbnail'] . '">
                <p>' . $row['title'] . '</p><p>&dollar;' . $row['price'] . '</p></div></a>';
                // echo '<script>$("#searchPagination").css("display","block!important");</script>';
            }
            echo '<script>element(' . $page . ', 1); $("#clear_genre_btn,#clear_sorting_btn").hide();
            </script>';
        } else {
            echo '<script>NoResultFound(0);$("#clear_genre_btn,#clear_sorting_btn").hide();</script>';
            // echo '<script>$("#searchPagination").css("display","none!important");</script>';
        }
    }
}

if (isset($_POST['crudSearch'])) {
    $start = 0;
    $limit = 10;
    $crudSearch = $_POST['crudSearch'];
    $_SESSION['crudSearch'] = $crudSearch;
    $sql = "SELECT * FROM games_data WHERE title LIKE '%$crudSearch%'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        if (mysqli_num_rows($query) > 0) {
            $search_sql = "SELECT * FROM games_data WHERE title LIKE '%$crudSearch%' ORDER BY created_date DESC LIMIT $start,$limit";
            $search_query = mysqli_query($conn, $search_sql);
            $counts = mysqli_num_rows($query);
            $page = ceil($counts / $limit);
            echo '<tr><th>photo</th><th>title</th><th>price</th><th>console</th><th>publisher</th><th>Action</th></tr>';
            while ($row = mysqli_fetch_assoc($search_query)) {
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
                echo '<script>$("#pagination_container").css("display","block");element(' . $page . ', 1);</script>';
            }
        } else {
            echo '<tr><td>No results found</td></tr>';
            echo '<script>$("#pagination_container").css("display","none");</script>';
        }
    }
}
