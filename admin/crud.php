<?php
include('../db.php');

if (isset($_POST['title']) && isset($_POST['price'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $platform = $_POST['platform'];
    $purchases = $_POST['inGamePurchases'];
    $publisher = $_POST['publisher'];
    $esrb = $_POST['esrb'];
    $genre = $_POST['genre'];
    $onlineStatus = $_POST['online_status'];
    $players = $_POST['players'];

    if (isset($_POST['onlinePlayerCount'])) {
        $onlinePlayers = $_POST['onlinePlayerCount'];
    } else {
        $onlinePlayers = 0;
    }

    $thumbnail = $_FILES['thumbnail']['name'];
    $poster = $_FILES['poster']['name'];
    $thumbnail_tmp = isset($_FILES['thumbnail']['tmp_name']) ? $_FILES['thumbnail']['tmp_name'] : null;
    $poster_tmp = isset($_FILES['poster']['tmp_name']) ? $_FILES['poster']['tmp_name'] : null;
    $gameLegal = $_POST['gameLegal'];
    $footer = $_POST['footer'];

    if ($thumbnail_tmp !== null) {
        $thumbnail = uniqid() . "_" . $thumbnail;
        move_uploaded_file($thumbnail_tmp, "../images/$thumbnail");
    } else {
        $thumbnail = 'noimage.png';
    }
    if ($poster_tmp !== null) {
        $poster = uniqid() . "_" . $poster;
        move_uploaded_file($poster_tmp, "../images/$poster");
    } else {
        $poster = 'noimage.png';
    }

    $sql = "INSERT INTO games_data(title,price,console,publisher,esrb,genre,online_status,players,online_players,purchases,thumbnail,poster,legal_info,footer,created_date)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,now())";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL error";
    } else {
        mysqli_stmt_bind_param($stmt, "sdisiiiiiissss", $title, $price, $platform, $publisher, $esrb, $genre, $onlineStatus, $players, $onlinePlayers, $purchases, $thumbnail, $poster, $gameLegal, $footer);
        mysqli_stmt_execute($stmt);
    }



    // $allowedImageTypes = ['image/jpg' ,'image/jpeg', 'image/png', 'image/gif',
    //                      'image/avif', 'image/webp'];

    // if (in_array($thumbnail_filetype, $allowedImageTypes) && in_array($poster_filetype, $allowedImageTypes)){

    // }else{
    //     echo 'Invalid file type. Please upload an image (JPG,JPEG,PNG,GIF,AVIF,webp).';
    // }
}



if (isset($_POST['select'])) {
    $sql = "SELECT id FROM games_data";
    $query = mysqli_query($conn, $sql);
    $counts = mysqli_num_rows($query);
    $start = 0;
    $limit = 10;
    $game_page = ceil($counts / $limit);
    $current_page = 1;
    $limit_sql = "SELECT id,title,price,thumbnail,console,publisher FROM games_data ORDER BY created_date DESC LIMIT $start,$limit";
    $limit_query = mysqli_query($conn, $limit_sql);
    echo '<tr><th>Photo</th><th>Title</th><th>Price</th><th>Console</th><th>Publisher</th><th>Action</th></tr>';
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
    echo '<script>element(' . $game_page . ', 1);</script>';
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $photo_sql = "SELECT thumbnail,poster FROM games_data WHERE id='$id'";
    $photo_query = mysqli_query($conn, $photo_sql);
    $photo_row = mysqli_fetch_assoc($photo_query);
    if ($photo_row['thumbnail'] !== 'noimage.png') {
        unlink('../images/' . $photo_row['thumbnail']);
    }

    if ($photo_row['poster'] !== 'noimage.png') {
        unlink('../images/' . $photo_row['poster']);
    }

    $sql = "DELETE FROM games_data WHERE id='$id'";
    mysqli_query($conn, $sql);
}

if (isset($_POST['eid'])) {
    $id = $_POST['eid'];
    $sql = "SELECT * FROM games_data WHERE id='$id'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    echo json_encode($row);
}

if (isset($_POST['uid'])) {
    $uid = $_POST['uid'];
    $utitle = $_POST['utitle'];
    $uprice = $_POST['uprice'];
    $uplatform = $_POST['uplatform'];
    $upurchases = $_POST['uinGamePurchases'];
    $upublisher = $_POST['upublisher'];
    $uesrb = $_POST['uesrb'];
    $ugenre = $_POST['ugenre'];
    $uonline_status = $_POST['uonline_status'];
    $uplayers = $_POST['uplayers'];
    if (isset($_POST['uonlinePlayerCount'])) {
        $uonlinePlayers = $_POST['uonlinePlayerCount'];
    } else {
        $uonlinePlayers = 0;
    }
    $uthumbnail = $_FILES['uthumbnail']['name'];
    $uposter = $_FILES['uposter']['name'];
    $uthumbnail_tmp = isset($_FILES['uthumbnail']['tmp_name']) ? $_FILES['uthumbnail']['tmp_name'] : null;
    $uposter_tmp = isset($_FILES['uposter']['tmp_name']) ? $_FILES['uposter']['tmp_name'] : null;
    $uthumbnailTxt = $_POST['uthumbnailTxt'];
    $uposterTxt = $_POST['uposterTxt'];
    $ugameLegal = $_POST['ugameLegal'];
    $ufooter = $_POST['ufooter'];

    if ($uthumbnail_tmp !== null && $uposter_tmp !== null) {
        $uthumbnail = uniqid() . "_" . $uthumbnail;
        move_uploaded_file($uthumbnail_tmp, "../images/$uthumbnail");
        $uposter = uniqid() . "_" . $uposter;
        move_uploaded_file($uposter_tmp, "../images/$uposter");
        if ($uthumbnailTxt !== 'noimage.png') {
            unlink('../images/' . $uthumbnailTxt);
        }
        if ($uposterTxt !== 'noimage.png') {
            unlink('../images/' . $uposterTxt);
        }

        $sql = "UPDATE games_data SET title=?, price=?, console=?, publisher=?, esrb=?, genre=?, online_status=?, players=?, online_players=?, purchases=?, thumbnail=?, poster=?, legal_info=?, footer=? WHERE id=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL error";
        } else {
            mysqli_stmt_bind_param($stmt, "sdisiiiiiissssi", $utitle, $uprice, $uplatform, $upublisher, $uesrb, $ugenre, $uonline_status, $uplayers, $uonlinePlayers, $upurchases, $uthumbnail, $uposter, $ugameLegal, $ufooter, $uid);
            mysqli_stmt_execute($stmt);
        }
    } elseif ($uthumbnail_tmp !== null) {
        $uthumbnail = uniqid() . "_" . $uthumbnail;
        move_uploaded_file($uthumbnail_tmp, "../images/$uthumbnail");
        if ($uthumbnailTxt !== 'noimage.png') {
            unlink('../images/' . $uthumbnailTxt);
        }
        $sql = "UPDATE games_data SET title=?, price=?, console=?, publisher=?, esrb=?, genre=?, online_status=?, players=?, online_players=?, purchases=?, thumbnail=?, legal_info=?, footer=? WHERE id=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL error";
        } else {
            mysqli_stmt_bind_param($stmt, "sdisiiiiiisssi", $utitle, $uprice, $uplatform, $upublisher, $uesrb, $ugenre, $uonline_status, $uplayers, $uonlinePlayers, $upurchases, $uthumbnail, $ugameLegal, $ufooter, $uid);
            mysqli_stmt_execute($stmt);
        }
    } elseif ($uposter_tmp !== null) {
        $uposter = uniqid() . "_" . $uposter;
        move_uploaded_file($uposter_tmp, "../images/$uposter");
        if ($uposterTxt !== 'noimage.png') {
            unlink('../images/' . $uposterTxt);
        }
        $sql = "UPDATE games_data SET title=?, price=?, console=?, publisher=?, esrb=?, genre=?, online_status=?, players=?, online_players=?, purchases=?, poster=?, legal_info=?, footer=? WHERE id=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL error";
        } else {
            mysqli_stmt_bind_param($stmt, "sdisiiiiiisssi", $utitle, $uprice, $uplatform, $upublisher, $uesrb, $ugenre, $uonline_status, $uplayers, $uonlinePlayers, $upurchases, $uposter, $ugameLegal, $ufooter, $uid);
            mysqli_stmt_execute($stmt);
        }
    } elseif ($uthumbnail_tmp == null && $uposter_tmp == null) {
        $sql = "UPDATE games_data SET title=?, price=?, console=?, publisher=?, esrb=?, genre=?, online_status=?, players=?, online_players=?, purchases=?, legal_info=?, footer=? WHERE id=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL error";
        } else {
            mysqli_stmt_bind_param($stmt, "sdisiiiiiissi", $utitle, $uprice, $uplatform, $upublisher, $uesrb, $ugenre, $uonline_status, $uplayers, $uonlinePlayers, $upurchases, $ugameLegal, $ufooter, $uid);
            mysqli_stmt_execute($stmt);
        }
    }
}
