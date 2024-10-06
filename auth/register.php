<?php
include('../db.php');
if (isset($_POST['signup_email']) && isset($_POST['signup_uname']) && isset($_POST['signup_pwd']) && isset($_FILES['photo']['name'])) {
    $email = $_POST['signup_email'];
    $uname = $_POST['signup_uname'];
    $password = $_POST['signup_pwd'];
    $photo = $_FILES['photo']['name'];
    $tmp = $_FILES['photo']['tmp_name'];
    $file_type = $_FILES['photo']['type'];
    $allowedImageTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($query) > 0) {
        echo '<script>alert("A user with this email already exists.");location.href="create_acc.php"</script>';
    } else if ($photo) {
        if (in_array($file_type, $allowedImageTypes)) {
            $photo = uniqid() . "_" . $photo;
            move_uploaded_file($tmp, "../images/$photo");
            $sql = "INSERT INTO users(email,name,password,photo,signup_date) VALUES
            ('$email','$uname','$password','$photo',now())";
            mysqli_query($conn, $sql);
            header("location:../index.php");
        } else {
            echo '<script>alert("Invalid file type. Please upload an image (JPG,JPEG,PNG,GIF).");location.href="create_acc.php"</script>';
        }
    } else {
        $photo = 'avatar.jpg';
        $sql = "INSERT INTO users(email,name,password,photo,signup_date) VALUES
            ('$email','$uname','$password','$photo',now())";
        mysqli_query($conn, $sql);
        header("location:../index.php");
    }
}
