<?php
    include('../db.php');
    if(isset($_POST['admin_name'])&&isset($_POST['admin_pwd'])){
        $admin = $_POST['admin_name'];
        $password = $_POST['admin_pwd'];
        $sql = "SELECT * FROM admin WHERE admin_name='$admin' AND 
        password='$password'";
        $query = mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($query);
        if(mysqli_num_rows($query)>0){
            session_start();
            $_SESSION['adminid']=$row['id'];
            header("location:admin_panel.php");
        }else{
            echo '<script>alert("Login failed,try again");location.href="admin.php"</script>';
        }
    }

?>