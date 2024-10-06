<?php
    include('../db.php');
    if(isset($_POST)) {
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
        $legal_info = $_POST['legal_info'];
        $footer = $_POST['footer'];

        $allowedImageTypes = ['image/jpg' ,'image/jpeg', 'image/png', 'image/gif',
                             'image/avif', 'image/webp'];

        if (in_array($thumbnail_filetype, $allowedImageTypes) && in_array($poster_filetype, $allowedImageTypes)){
            $thumbnail = uniqid()."_".$thumbnail;
            $poster = uniqid()."_".$poster;
            move_uploaded_file($thumbnail_tmp,"../images/$thumbnail");
            move_uploaded_file($poster_tmp,"../images/$poster");
            // $sql = "INSERT INTO games_data(title,price,console,publisher,esrb,genre,online_status,players,online_players,purchases,thumbnail,poster,legal_info,footer,created_date)
            // VALUES ('$game_title','$price','$console','$publisher','$esrb','$genre','$online','$players','$online_player_counts','$purchases','$thumbnail','$poster','$legal_info','$footer',now())";
            // echo "Success";
            //  mysqli_query($conn,$sql);
            $sql = "INSERT INTO games_data(title,price,console,publisher,esrb,genre,online_status,players,online_players,purchases,thumbnail,poster,legal_info,footer,created_date)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,now())";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "SQL error";
            }else{
                mysqli_stmt_bind_param($stmt, "sdisiiiiiissss", $game_title, $price, $console, $publisher, $esrb, $genre, $online, $players, $online_player_counts, $purchases, $thumbnail, $poster, $legal_info, $footer);
                mysqli_stmt_execute($stmt);
            }   
            header('location:tabletesting.php');
        }else{
            echo '<script>alert("Invalid file type. Please upload an image (JPG,JPEG,PNG,GIF,AVIF,webp).");location.href="admin_panel.php"</script>';
        }
}
else{
    echo 'data not received';
}
?>