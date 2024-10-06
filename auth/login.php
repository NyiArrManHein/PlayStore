<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src=" https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <link rel="stylesheet" href="../styles.css">
  <script src="../index.js"></script>
 </head>
<body class="d-flex justify-content-center align-items-center min-vh-100">
      <div class="border" style="width: 400px; height: 550px;">
          <div class="container-fluid" style="height: 60px; background-color: #141414;">
            <div class="row">
              <div class="col-4 pt-3"><img id="login_backbtn" src="../images/login_backbtn.png" class="unseen" alt="" style="cursor: pointer;"></div>
              <div class="col-6 pt-3"><img src="../images/sonylogo.png" alt=""></div>
              <div class="col pt-3"><img src="../images/login_close.png" alt=""></div>
            </div>
          </div>

          <div class="d-flex justify-content-center align-items-center" style="height: 90px; background-color:#00439C;">
            <img src="../images/login_pslogo.png" alt="">
          </div>
          
          <p class="pt-2 ps-3" style="font-size: 14px; margin: 0;">Sign in to PlayStation with one of your Sony accounts.</p>
          <p class="text-primary ps-3" style="font-size: 14px;">Learn More</p>
          
          
            <div class="d-flex flex-column justify-content-center align-items-center p-3">
              <form method="POST" action="signin.php">
              <input class="login_email p-1" type="email" size="40" name="email" placeholder="Sign-In ID (Email Address)">
              <input class="login_pwd p-1 mt-2" type="password" size="40" name="password" placeholder="Password">
              <!-- <button id="login_nextbtn" class="border-0 text-white mt-3" style="font-size: 14px; width:340px; height: 36px; background-color: #4467c7;">Next</button> -->
              <button id="signin_btn" class="border-0 text-white mt-3" style="font-size: 14px; width:340px; height: 36px; background-color: #4467c7;">Sign In</button>
              </form>
            </div>
         

          <p class="text-center text-primary mt-3" style="font-size: 13px;">Trouble Signing In?</p>

          <div class="d-flex justify-content-center pt-3">
            <a href="signup.php"><button class="create_acc_btn bg-white" style="font-size: 14px; width:340px; height: 36px; border: 1px solid rgb(145, 129, 129);">Create New Account</button></a>
          </div>

        
          
        </div>

     
</body>
</html>