<?php
    include('../db.php');
    if(isset($_POST)){
        $game_title = $_POST['title'];
        $price = $_POST['price'];
        $console = $_POST['radio'];
        if(isset($_POST['in_game_purchases'])){
            $purchases = $_POST['in_game_purchases'];
        }else{
            $purchases = 0;
        }
        $publisher = $_POST['publisher'];
        $esrb = $_POST['esrb_ratings'];
        $genre = $_POST['genre'];
        $online = $_POST['online'];
        $players = $_POST['players'];
        if(isset($_POST['online_player_counts'])){
            $online_player_counts = $_POST['online_player_counts'];
        }else{
            $online_player_counts = 0;
        }
        $thumbnail = $_FILES['thumbnail']['name'];
        $thumbnail_tmp = $_FILES['thumbnail']['tmp_name'];
        $thumbnail_filetype = $_FILES['thumbnail']['type'];
        $poster = $_FILES['poster']['name'];
        $poster_tmp = $_FILES['poster']['tmp_name'];
        $poster_filetype = $_FILES['poster']['type'];
        $thumbnail_txt = $_POST['thumbnail_txt'];
        $poster_txt = $_POST['poster_txt'];
        
        
        $legal_info = $_POST['legal_info'];
        $footer = $_POST['footer'];
        $allowedImageTypes = ['image/jpg' ,'image/jpeg', 'image/png', 'image/gif',
                             'image/avif', 'image/webp'];
        if(empty($thumbnail)){
            $update_sql = "UPDATE games_data SET title = ? ,price = ?,console = ?,publisher = ?,esrb = ?,
                           genre = ?,online_status = ?,players = ?,online_players = ?,purchases = ?,
                           poster = ?,legal_info = ?,footer = ?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $update_sql)){
                echo "SQL error";
            }else{
                mysqli_stmt_bind_param($stmt, "sdisiiiiiisss", $game_title, $price, $console, $publisher, $esrb, $genre, $online, $players, $online_player_counts, $purchases, $poster, $legal_info, $footer);
                mysqli_stmt_execute($stmt);
            } 
        }elseif(empty($poster)){
            $update_sql = "UPDATE games_data SET title = ? ,price = ?,console = ?,publisher = ?,esrb = ?,
                           genre = ?,online_status = ?,players = ?,online_players = ?,purchases = ?,
                           thumbnail = ?,legal_info = ?,footer = ?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $update_sql)){
                echo "SQL error";
            }else{
                mysqli_stmt_bind_param($stmt, "sdisiiiiiisss", $game_title, $price, $console, $publisher, $esrb, $genre, $online, $players, $online_player_counts, $purchases, $thumbnail, $legal_info, $footer);
                mysqli_stmt_execute($stmt);
            } 
        }elseif(empty($thumbnail) && empty($poster) ){
            $update_sql = "UPDATE games_data SET title = ? ,price = ?,console = ?,publisher = ?,esrb = ?,
                           genre = ?,online_status = ?,players = ?,online_players = ?,purchases = ?,
                           thumbnail = ?,legal_info = ?,footer = ?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $update_sql)){
                echo "SQL error";
            }else{
                mysqli_stmt_bind_param($stmt, "sdisiiiiiiss", $game_title, $price, $console, $publisher, $esrb, $genre, $online, $players, $online_player_counts, $purchases, $legal_info, $footer);
                mysqli_stmt_execute($stmt);
            } 
        }else{
            if (in_array($thumbnail_filetype, $allowedImageTypes) && in_array($poster_filetype, $allowedImageTypes)){
                unlink('../images/'.$thumbnail_txt);
                unlink('../images/'.$poster_txt);
                $thumbnail = uniqid()."_".$thumbnail;
                $poster = uniqid()."_".$poster;
                move_uploaded_file($thumbnail_tmp,"../images/$thumbnail");
                move_uploaded_file($poster_tmp,"../images/$poster");
                $update_sql = "UPDATE games_data SET title = ? ,price = ?,console = ?,publisher = ?,esrb = ?,
                       genre = ?,online_status = ?,players = ?,online_players = ?,purchases = ?,
                       thumbnail = ?,poster = ?,legal_info = ?,footer = ?";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $update_sql)){
                    echo "SQL error";
                }else{
                    mysqli_stmt_bind_param($stmt, "sdisiiiiiissss", $game_title, $price, $console, $publisher, $esrb, $genre, $online, $players, $online_player_counts, $purchases, $thumbnail, $poster, $legal_info, $footer);
                    mysqli_stmt_execute($stmt);
                } 
            }else{
                echo '<script>alert("Invalid file type. Please upload an image (JPG,JPEG,PNG,GIF,AVIF,webp).");location.href="admin_panel.php"</script>';
            }
        }
    }
?>