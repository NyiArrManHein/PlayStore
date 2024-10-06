<?php
  include('../db.php');
  if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND
            password = '$password'");
    $row = mysqli_fetch_assoc($sql);
    if(mysqli_num_rows($sql)>0){
        session_start();
        $_SESSION['id'] = $row['id'];
        header('location:../index.php');
    }else{
      echo '<script>alert("Login failed,try again");location.href="login.php"</script>';
    }
  }  
?>