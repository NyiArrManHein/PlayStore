<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body>
<body class="d-flex justify-content-center align-items-center min-vh-100">
<div class="border" style="width: 500px; height: 570px;">
      <div class="container-fluid" style="height: 60px; background-color: #141414;">
        <div class="row">
          <div class="col-4 pt-3"></div>
          <div class="col-6 pt-3"><img class="ms-3" src="../images/sonylogo.png" alt=""></div>
          <div class="col pt-3"><img class="ms-4" src="../images/login_close.png" alt=""></div>
        </div>
      </div>

      <p class="text-center mt-3" style="font-size: 20px;">Admin</p>

      <form method="POST" action="admin_login.php">
        <div class="d-flex flex-column justify-content-center align-items-center p-3">
        <input class="p-1 mt-2" type="text" name="admin_name" size="40" placeholder="Admin" required>
        <input class="p-1 mt-2" type="password" name="admin_pwd" size="40" placeholder="Password" required>
        <button id="login_btn" class="border-0 text-white mt-3" style="font-size: 14px; width:340px; height: 36px; background-color: #4467c7;">SignIn</button>
        </div>
      </form>
</div>
</body>
</html>