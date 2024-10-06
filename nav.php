<?php
include('db.php');
$uId = null;
$orderCount = null;
if (isset($_SESSION['id'])) {
  $uId = $_SESSION['id'];
}

if (isset($_SESSION['cart'])) {
  $orderCount = count($_SESSION['cart']);
}

$profilesql = mysqli_query($conn, "SELECT photo FROM users WHERE id='$uId'");
$profilerow = mysqli_fetch_assoc($profilesql);

?>
<style>
  body.overflow-hidden {
    overflow: hidden;
  }

  .navUnseen {
    display: none !important;
  }
</style>
<!-- ................Header1.................. -->
<p class="h5 text-white bg-dark text-end p-2 header1">SONY</p>



<!-- .....................Header2.................. -->

<div class="header2_mobile container-fluid p-2 unseen">
  <div class="row">
    <div class="col-4 d-flex align-items-center">
      <button id="hamburger_btn" class="btn"><img src="images/hamburger_icon.png" alt=""></button>
      <button id="close_btn" class="btn unseen"><img src="images/close_icon.png" alt=""></button>
      <a href="searching.php?coming_from_index=true" style="text-decoration: none;color: inherit;" id="search_link"><i class="fa-solid fa-magnifying-glass ms-3"></i></a>
    </div>
    <div class="col-4 text-center">
      <img src="images/pslogo.png" width="40px" height="30px">
    </div>
    <div class="col-4 d-flex justify-content-end">
      <button class="signIn_btn rounded-pill text-white bg-primary px-3">Sign In</button>
      <a href="orderCart.php?cart=1" class="cart position-relative mx-2 unseen" style="text-decoration: none;color: inherit;"><img style="cursor: pointer;" src="images/cart.png" alt="">
        <span class="cartBadge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $orderCount; ?></span></a>
      <div class="userProfile d-inline-block navUnseen">
        <button type="button" class="border-0 bg-white" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="images/<?php echo $profilerow['photo']; ?>" class="rounded-circle" width="34px" height="34px" alt="">
        </button>

        <ul class="dropdown-menu" style="max-width: 100px;">
          <li><a class="dropdown-item" href="gamelibrary.php?library=1">Game Library</a></li>
          <li><a class="dropdown-item" href="userlogout.php">Sign Out</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- ....................Sidebar buttons here.......................... -->
<div id="sidebar_btn_gp" class="unseen" style="padding-top: 30px;">
  <button class="border-0 bg-white vw-100 my-2 d-flex justify-content-between align-items-center" id="games_btn" style="margin-bottom: 10px;">
    <div>
      <img id="games_unfill_logo" src="images/controller_logo.png" alt="" style="margin-right: 30px; margin-left: 12px;">
      <img id="games_fill_logo" class="unseen" src="images/controller_fill_logo.png" style="margin-right: 30px; margin-left: 12px;" alt="">
      <span>Games</span>
    </div>

    <div class="me-2">
      <img src="images/sidebar_next_icon.png" alt="">
    </div>
  </button>

  <button class="border-0 bg-white vw-100 my-3 d-flex justify-content-between align-items-center" id="hardware_btn" style="margin-bottom: 10px;">
    <div>
      <img id="hardware_unfill_logo" src="images/hardware_logo.png" alt="" style="margin-right: 28px; margin-left: 12px;">
      <img id="hardware_fill_logo" class="unseen" src="images/hardware_fill_logo.png" style="margin-right: 28px; margin-left: 12px;" alt="">
      <span>Hardware</span>
    </div>

    <div class="me-2">
      <img src="images/sidebar_next_icon.png" alt="">
    </div>
  </button>

  <button class="border-0 bg-white vw-100 my-3 d-flex justify-content-between align-items-center" id="services_btn" style="margin-bottom: 6px;">
    <div>
      <img id="services_unfill_logo" src="images/services_logo.png" alt="" style="margin-right: 32px; margin-left: 13px;">
      <img id="services_fill_logo" class="unseen" src="images/services_fill_logo.png" style="margin-right: 32px; margin-left: 13px;" alt="">
      <span>Services</span>
    </div>

    <div class="me-2">
      <img src="images/sidebar_next_icon.png" alt="">
    </div>
  </button>


  <button class="border-0 bg-white vw-100 my-3 d-flex justify-content-between align-items-center" id="news_btn" style="margin-bottom: 8px;">
    <div>
      <img id="news_unfill_logo" src="images/news_logo.png" alt="" style="margin-right: 35px; margin-left: 14px;">
      <img id="news_fill_logo" class="unseen" src="images/news_fill_logo.png" style="margin-right: 35px; margin-left: 14px;" alt="">
      <span>News</span>
    </div>

    <div class="me-2">
      <img src="images/sidebar_next_icon.png" alt="">
    </div>
  </button>

  <button class="border-0 bg-white vw-100 my-3 d-flex justify-content-between align-items-center" id="shop_btn" style="margin-bottom: 8px;">
    <div>
      <img id="shop_unfill_logo" src="images/shop_logo.png" alt="" style="margin-right: 36px; margin-left: 12px;">
      <img id="shop_fill_logo" class="unseen" src="images/shop_fill_logo.png" style="margin-right: 36px; margin-left: 15px;" alt="">
      <span>Shop</span>
    </div>

    <div class="me-2">
      <img src="images/sidebar_next_icon.png" alt="">
    </div>
  </button>

  <button class="border-0 bg-white vw-100 my-3 d-flex justify-content-between align-items-center" id="support_btn" style="margin-bottom: 10px;">
    <div>
      <img id="support_unfill_logo" src="images/support_logo.png" alt="" style="margin-right: 33px; margin-left: 10px;">
      <img id="support_fill_logo" class="unseen" src="images/support_fill_logo.png" style="margin-right: 33px; margin-left: 10px;" alt="">
      <span>Support</span>
    </div>

    <div class="me-2">
      <img src="images/sidebar_next_icon.png" alt="">
    </div>
  </button>



  <a href="wishlist.php?wish=1" style="text-decoration: none;color: inherit;">
    <div class="mwishlist navUnseen border-0 bg-white vw-100 my-3 d-flex align-items-center">
      <img width="32px" style="margin-right: 34px; margin-left: 11px;" src="images/wishlist.png" alt="">
      <span>Wishlist</span>
    </div>
  </a>






  <!-- .................Sidebar content here................. -->
  <div id="sidebar_container">

    <!-- ......................GameContainer..................... -->
    <div class="games_container sidebar_close_btn unseen" style="padding:40px 0;">
      <img class="ms-3" src="images/vertical_hamburger.png" alt="">
      <p class="d-inline ms-2" style="font-size: 14px;">Games</p>
    </div>
    <div class="games_container unseen" id="games_container">
      <div class="d-flex justify-content-around">
        <button class="ps5link btn d-flex flex-column align-items-center justify-content-center my-2"><img src="images/ps5.png" width="50px"><span style="font-size: 13px;">PS5</span></button>
        <button class="ps4link btn d-flex flex-column align-items-center justify-content-center my-2"><img src="images/ps4.png" width="50px"><span style="font-size: 13px;">PS4</span></button>
      </div>

      <div class="d-flex justify-content-around">
        <button class="vrlink btn d-flex flex-column align-items-center justify-content-center my-2"><img src="images/PsVR.png" width="50px"><span style="font-size: 13px;">PS&nbsp;VR</span></button>
        <button class="pluslink btn d-flex flex-column align-items-center justify-content-center my-2"><img src="images/psplus.png" width="50px"><span style="font-size: 13px;">PS&nbsp;Plus</span></button>
      </div>


      <div class="d-flex justify-content-around">
        <button class="storelink btn d-flex flex-column align-items-center justify-content-center my-2"><img src="images/psstore.png" width="50px"><span style="font-size: 13px;">Buy&nbsp;Games</span></button>
        <div style="width: 89px; height: 80px; background-color: white"></div>
      </div>
      <hr>
      <div class="ps-4">
        <p class="indieslink my-2" style="font-size: 13px; cursor: pointer;">PlayStation&nbsp;Indies</p>
        <p class="4on5link my-2" style="font-size: 13px; cursor: pointer;">PS4&nbsp;games&nbsp;on&nbsp;PS5</p>
        <p class="freeplaylink my-2" style="font-size: 13px; cursor: pointer;">Free&nbsp;to&nbsp;Play</p>
        <p class="psonpclink my-2" style="font-size: 13px; cursor: pointer;">PlayStation&nbsp;games&nbsp;on&nbsp;PC</p>
        <p class="dealofferlink my-2" style="font-size: 13px; cursor: pointer;">Deals&nbsp;&amp;offers</p>
      </div>
    </div>


    <!-- ......................HardwareContainer..................... -->
    <div class="hardware_container sidebar_close_btn unseen" style="padding:40px 0;">
      <img class="ms-3" src="images/vertical_hamburger.png" alt="">
      <p class="d-inline ms-2" style="font-size: 14px;">Hardware</p>
    </div>
    <div class="hardware_container unseen" id="hardware_container">
      <div class="d-flex justify-content-around">
        <button class="ps5link btn d-flex flex-column align-items-center justify-content-center my-2"><img src="images/ps5.png" width="50px"><span style="font-size: 13px;">PS5</span></button>
        <button class="ps4link btn d-flex flex-column align-items-center justify-content-center my-2"><img src="images/ps4.png" width="50px"><span style="font-size: 13px;">PS4</span></button>
      </div>

      <div class="d-flex justify-content-around">
        <button class="ps4prolink btn d-flex flex-column align-items-center justify-content-center my-2"><img src="images/ps4pro.png" width="50px"><span style="font-size: 13px;">PS4&nbsp;Pro</span></button>
        <button class="vr2link btn d-flex flex-column align-items-center justify-content-center my-2"><img src="images/psVR2.png" width="50px"><span style="font-size: 13px;">PS&nbsp;VR2</span></button>
      </div>
      <hr>
      <div class="ps-4">
        <p class="dualsenselink my-2" style="font-size: 13px; cursor: pointer;">DualSense&nbsp;wireless&nbsp;controller</p>
        <p class="pulselink my-2" style="font-size: 13px; cursor: pointer;">PULSE&nbsp;3D&nbsp;wireless&nbsp;headset</p>
        <p class="dualshocklink my-2" style="font-size: 13px; cursor: pointer;">DUALSHOCK&nbsp;4&nbsp;wireless&nbsp;controller</p>
        <p class="accessorieslink my-2" style="font-size: 13px; cursor: pointer;">PS5&nbsp;&amp;&nbsp;PS4&nbsp;accessories</p>
        <p class="vrlink my-2" style="font-size: 13px; cursor: pointer;">PlayStation&nbsp;VR</p>
      </div>
    </div>


    <!-- ......................ServicesContainer..................... -->
    <div class="services_container sidebar_close_btn unseen" style="padding:40px 0;">
      <img class="ms-3" src="images/vertical_hamburger.png" alt="">
      <p class="d-inline ms-2" style="font-size: 14px;">Services</p>
    </div>
    <div class="services_container unseen" id="services_container">
      <div class="d-flex justify-content-around">
        <button class="pluslink btn d-flex flex-column align-items-center justify-content-center my-2"><img src="images/psplus.png" width="50px"><span style="font-size: 13px;">PS&nbsp;Plus</span></button>
        <button class="psstarlink btn d-flex flex-column align-items-center justify-content-center my-2"><img src="images/psstars.png" width="50px"><span style="font-size: 13px;">PS&nbsp;Stars</span></button>
      </div>
      <hr>
      <div class="ps-4">
        <p class="5enterlink my-2" style="font-size: 13px; cursor: pointer;">PS5&nbsp;entertainment</p>
        <p class="4enterlink my-2" style="font-size: 13px; cursor: pointer;">PS4&nbsp;entertainment</p>
      </div>
    </div>

    <!-- ......................NewsContainer..................... -->
    <div class="news_container sidebar_close_btn unseen" style="padding:40px 0;">
      <img class="ms-3" src="images/vertical_hamburger.png" alt="">
      <p class="d-inline ms-2" style="font-size: 14px;">News</p>
    </div>
    <div class="news_container unseen" id="news_container">
      <div class="d-flex justify-content-around">
        <button class="bloglink btn d-flex flex-column align-items-center justify-content-center my-2"><img src="images/psblog.png" width="50px"><span style="font-size: 13px;">PS&nbsp;Blog</span></button>
        <button class="monthlink btn d-flex flex-column align-items-center justify-content-center my-2"><img src="images/calendar.png" width="50px"><span style="font-size: 13px;">This&nbsp;Month&nbsp;on<br>PlayStation</span></button>
      </div>
      <hr>
      <div class="ps-4">
        <p class="competitionlink my-2" style="font-size: 13px; cursor: pointer;">Competition&nbsp;Center</p>
        <p class="accessibilitylink my-2" style="font-size: 13px; cursor: pointer;">Accessibility</p>
        <p class="safetylink my-2" style="font-size: 13px; cursor: pointer;">Privacy&nbsp;&amp;Safety</p>
      </div>
    </div>

    <!-- ......................ShopContainer..................... -->
    <div class="shop_container sidebar_close_btn unseen" style="padding:40px 0;">
      <img class="ms-3" src="images/vertical_hamburger.png" alt="">
      <p class="d-inline ms-2" style="font-size: 14px;">Shop</p>
    </div>
    <div class="shop_container unseen" id="shop_container">
      <div class="d-flex justify-content-around">
        <button class="hardwarelink btn d-flex flex-column align-items-center justify-content-center my-2"><img src="images/ps4pro.png" width="50px"><span style="font-size: 13px;">Hardware&nbsp;and<br>Discs</span></button>
        <button class="digitalgameslink btn d-flex flex-column align-items-center justify-content-center my-2"><img src="images/psstore.png" width="50px"><span style="font-size: 13px;">Digital&nbsp;Games<br>and&nbsp;Services</span></button>
      </div>

      <div class="d-flex justify-content-around">
        <button class="merchandiselink btn d-flex flex-column align-items-center justify-content-center my-2"><img src="images/psmerchandise.png" width="50px"><span style="font-size: 13px;">Official<br>Merchandise</span></button>
        <div style="width: 99px; height: 100px;"></div>
      </div>
      <hr>
      <div class="ps-4">
        <p class="buyps5link my-2" style="font-size: 13px; cursor: pointer;">Buy&nbsp;a&nbsp;PS5</p>
        <p class="releaseslink my-2" style="font-size: 13px; cursor: pointer;">New&nbsp;releases</p>
        <p class="discountslink my-2" style="font-size: 13px; cursor: pointer;">Latest&nbsp;discounts</p>
        <p class="giftcardlink my-2" style="font-size: 13px; cursor: pointer;">Buy&nbsp;gift&nbsp;card</p>
        <p class="pluslink my-2" style="font-size: 13px; cursor: pointer;">Subscribe&nbsp;to&nbsp;PS&nbsp;Plus</p>
      </div>
    </div>

    <!-- ......................SupportContainer..................... -->
    <div class="support_container sidebar_close_btn unseen" style="padding:40px 0;">
      <img class="ms-3" src="images/vertical_hamburger.png" alt="">
      <p class="d-inline ms-2" style="font-size: 14px;">Support</p>
    </div>
    <div class="support_container unseen" id="support_container">
      <div class="d-flex justify-content-around">
        <button class="supportlink btn d-flex flex-column align-items-center justify-content-center my-2"><img src="images/support.png" width="50px"><span style="font-size: 13px;">Support</span></button>
        <button class="psnlink btn d-flex flex-column align-items-center justify-content-center my-2"><img src="images/psnstatus.png" width="50px"><span style="font-size: 13px;">PSN&nbsp;Status</span></button>
      </div>
      <hr>
      <div class="ps-4">
        <p class="accountlink my-2" style="font-size: 13px; cursor: pointer;">Account</p>
        <p class="supportstorelink my-2" style="font-size: 13px; cursor: pointer;">Store</p>
        <p class="tieredlink my-2" style="font-size: 13px; cursor: pointer;">Tiered&nbsp;Services</p>
        <p class="supportgameslink my-2" style="font-size: 13px; cursor: pointer;">Games</p>
        <p class="supporthardwarelink my-2" style="font-size: 13px; cursor: pointer;">Hardware</p>
      </div>
    </div>

  </div>

</div>

<div class="header2_desktop d-flex justify-content-between mb-3">

  <div>
    <img class="ms-3" src="images/pslogo.png" class="mb-1" width="25px" alt="">
    <button class="border-0 bg-white btn" id="games_btn" style="font-size: 12px;">Games <img id="up1" src="images/arrowicon.png" width="11px"> </button>
    <button class="border-0 bg-white btn" id="hardware_btn" style="font-size: 12px;">Hardware <img id="up2" src="images/arrowicon.png" width="11px"></button>
    <button class="border-0 bg-white btn" id="services_btn" style="font-size: 12px;">Services <img id="up3" src="images/arrowicon.png" width="11px"></button>
    <button class="border-0 bg-white btn" id="news_btn" style="font-size: 12px;">News <img id="up4" src="images/arrowicon.png" width="11px"></button>
    <button class="border-0 bg-white btn" id="shop_btn" style="font-size: 12px;">Shop <img id="up5" src="images/arrowicon.png" width="11px"></button>
    <button class="border-0 bg-white btn" id="support_btn" style="font-size: 12px;">Support <img id="up6" src="images/arrowicon.png" width="11px"></button>
  </div>

  <div>
    <a class="signIn_btn" href="auth/login.php" style="text-decoration: none;color: inherit;"><button class="rounded-pill text-white bg-primary px-3">Sign In</button></a>
    <div class="userProfile d-inline-block navUnseen">
      <button type="button" class="border-0 bg-white" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="images/<?php echo $profilerow['photo']; ?>" class="rounded-circle" width="34px" height="34px" alt="">
      </button>

      <ul class="dropdown-menu" style="max-width: 100px;">
        <li><a class="dropdown-item" href="gamelibrary.php?library=1">Game Library</a></li>
        <li><a class="dropdown-item" href="userlogout.php">Sign Out</a></li>
      </ul>
    </div>

    <!-- <a id="gamelibrary" href="gamelibrary.php" class="unseen" style="text-decoration: none;color: inherit;"><img src="images/gamelibrary.png" width="34px" alt=""></a> -->
    <a href="wishlist.php?wish=1" style="text-decoration: none;color: inherit;"><img style="cursor: pointer;" class="wishlist mx-2 unseen" src="images/wishlist.png" alt=""></a>
    <!-- <img id="cart" class="mx-2 unseen" style="cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas" aria-controls="offcanvasRight" src="images/cart.png" alt=""> -->
    <a href="orderCart.php?cart=1" class="cart position-relative mx-2 unseen" style="text-decoration: none;color: inherit;"><img style="cursor: pointer;" src="images/cart.png" alt="">
      <span class="cartBadge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $orderCount; ?></span></a>
    <a href="searching.php?coming_from_index=true" style="text-decoration: none;color: inherit;" id="search_link"><i style="cursor:pointer;" class="fa-solid fa-magnifying-glass mx-3"></i></a>
    <i data-bs-toggle="modal" style="cursor:pointer;" data-bs-target="#search-modal" class="fa-solid fa-magnifying-glass ms-3 unseen" id="search_modal"></i>
  </div>
</div>

<!-- .............CartOffcanvas.............. -->
<div style="background-color: #F3F3F3; width: 470px;" class="offcanvas offcanvas-end p-1" tabindex="-1" id="cartOffcanvas" aria-labelledby="offcanvasRight-label">
  <div class="offcanvas-header mb-5">
    <h5 class="offcanvas-title" id="offcanvasRight-label">Your Cart</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <!-- <div class="d-flex flex-column justify-content-center align-items-center">
      <img src="images/offcanvas_cart.svg" class="mb-3" width="180px" height="282px" alt="">
      <h5 class="ms-3" style="color: gray;">Your cart is empty</h5>
    </div> -->



    <div class="d-flex flex-column border-white p-3" id="gamecartContainer" style="background-color: #FCFCFC">
      <!-- ..................startOffcanvasTesting..................... -->
      <!-- ....................endOffcanvasTesting........................... -->
    </div>
  </div>
</div>


<!-- Upbar content here -->
<div id="upbar" class="header-shadow">

  <!-- ......................GameContainer......................... -->
  <div class="games_container unseen">
    <div class="d-flex justify-content-center">
      <button class="ps5link btn"><img src="images/ps5.png" class="mx-4"><span class="d-block" style="font-size: 12px;">PS5</span></button>
      <button class="ps4link btn"><img src="images/ps4.png" class="mx-4"><span class="d-block" style="font-size: 12px;">PS4</span></button>
      <button class="vrlink btn"><img src="images/PsVR.png" class="mx-4"><span class="d-block" style="font-size: 12px;">PS VR</span></button>
      <button class="pluslink btn"><img src="images/psplus.png" class="mx-4"><span class="d-block" style="font-size: 12px;">PS Plus</span></button>
      <button class="storelink btn"><img src="images/psstore.png" class="mx-4"><span class="d-block" style="font-size: 12px;">Buy Games</span></button>
    </div>
    <hr style="margin-top: 50px;">

    <!-- .......................GameFooter....................... -->
    <div class="footer_container d-flex justify-content-center">

      <div class="indieslink d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 8px; height: 8px;"></span>
        <span class="content_1">PlayStation&nbsp;</span><span class="content_2">Indies</span>
      </div>



      <div class="4on5link d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 8px; height: 8px;"></span>
        <span class="content_1">PS4&nbsp;games&nbsp;on&nbsp;</span><span class="content_2">PS5</span>
      </div>



      <div class="freeplaylink d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 8px; height: 8px;"></span>
        <span class="content_1">Free&nbsp;to&nbsp;</span><span class="content_2">Play</span>
      </div>



      <div class="psonpclink d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 8px; height: 8px;"></span>
        <span class="content_1">PlayStation&nbsp;games&nbsp;</span><span class="content_2">on&nbsp;PC</span>
      </div>



      <div class="dealofferlink d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 8px; height: 8px;"></span>
        <span class="content_1">Deals&nbsp;&amp;&nbsp;</span><span class="content_2">offers</span>
      </div>
    </div>
  </div>


  <!-- ......................HardwareContainer......................... -->
  <div class="hardware_container unseen">
    <div class="d-flex justify-content-center">
      <button class="ps5link btn"><img src="images/ps5.png" class="mx-4"><span class="d-block">PS5</span></button>
      <button class="ps4link btn"><img src="images/ps4.png" class="mx-4"><span class="d-block">PS4</span></button>
      <button class="ps4prolink btn"><img src="images/ps4pro.png" class="mx-4"><span class="d-block">PS4 Pro</span></button>
      <button class="vr2link btn"><img src="images/psVR2.png" class="mx-4"><span class="d-block">PS VR2</span></button>
    </div>
    <hr style="margin-top: 45px;">

    <!-- ..........................HardwareFooter........................... -->
    <div class="footer_container d-flex justify-content-center">

      <div class="dualsenselink d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 10px; height: 10px;"></span>
        <span class="h_content_1">DualSense&nbsp;wireless&nbsp;</span><span class="h_content_2">controller</span>
      </div>

      <div class="pulselink d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 10px; height: 10px;"></span>
        <span class="h_content_1">PULSE&nbsp;3D&nbsp;wireless&nbsp;</span><span class="h_content_2">headset</span>
      </div>

      <div class="dualshocklink d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 10px; height: 10px;"></span>
        <span class="h_content_1">DUALSHOCK&nbsp;4&nbsp;</span><span class="h_content_2">wireless&nbsp;controller</span>
      </div>

      <div class="accessorieslink d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 10px; height: 10px;"></span>
        <span class="h_content_1">PS5&nbsp;&amp;PS4&nbsp;</span><span class="h_content_2">accessories</span>
      </div>

      <div class="vrlink d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 10px; height: 10px;"></span>
        <span class="h_content_1">PlayStation&nbsp;</span><span class="h_content_2">VR</span>
      </div>

    </div>
  </div>


  <!-- ......................ServicesContainer......................... -->
  <div class="services_container unseen">
    <div class="d-flex justify-content-center">
      <button class="pluslink btn"><img src="images/psplus.png" class="mx-4"><span class="d-block">PS Plus</span></button>
      <button class="psstarlink btn"><img src="images/psstars.png" class="mx-4"><span class="d-block">PS Stars</span></button>
    </div>
    <hr style="margin-top: 45px;">

    <!-- ....................ServicesFooter................... -->

    <div class="footer_container d-flex justify-content-center">
      <div class="5enterlink d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 10px; height: 10px;"></span>
        <span>PS5&nbsp;entertainment</span>
      </div>

      <div class="4enterlink d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 10px; height: 10px;"></span>
        <span>PS4&nbsp;entertainment</span>
      </div>
    </div>
  </div>

  <!-- ......................NewsContainer......................... 35 -->
  <div class="news_container unseen">
    <div class="d-flex justify-content-center">
      <button class="bloglink btn mb-3"><img src="images/psblog.png" class="mx-4"><span class="d-block">PS Blog</span></button>
      <button class="monthlink btn"><img src="images/calendar.png" class="mx-4"><span class="d-block">This Month on<br>PlayStation</span></button>
    </div>
    <hr style="margin-top: 20px;">

    <!-- .....................NewsFooter..................... -->
    <div class="footer_container d-flex justify-content-center">
      <div class="competitionlink d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 10px; height: 10px;"></span>
        <span>Competition&nbsp;Center</span>
      </div>

      <div class="accessibilitylink d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 10px; height: 10px;"></span>
        <span>Accessibility</span>
      </div>

      <div class="safetylink d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 10px; height: 10px;"></span>
        <span>Privacy&nbsp;&amp;&nbsp;Safety</span>
      </div>
    </div>
  </div>

  <!-- ......................ShopContainer......................... 35 -->
  <div class="shop_container unseen">
    <div class="d-flex justify-content-center">
      <button class="hardwarelink btn mb-3"><img src="images/ps4pro.png" class="mx-4"><span class="d-block">Hardware and Discs</span></button>
      <button class="digitalgameslink btn"><img src="images/psstore.png" class="mx-4"><span class="d-block">Digital Games and<br>Services</span></button>
      <button class="merchandiselink btn mb-3"><img src="images/psmerchandise.png" class="mx-4"><span class="d-block">Official Merchandise</span></button>
    </div>
    <hr style="margin-top: 20px;">

    <!-- .....................ShopFooter..................... -->
    <div class="footer_container d-flex justify-content-center">
      <div class="buyps5link d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 10px; height: 10px;"></span>
        <span>Buy&nbsp;a&nbsp;PS5</span>
      </div>

      <div class="releaseslink d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 10px; height: 10px;"></span>
        <span>New&nbsp;releases</span>
      </div>

      <div class="discountslink d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 10px; height: 10px;"></span>
        <span>Latest&nbsp;discounts</span>
      </div>

      <div class="giftcardlink d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 10px; height: 10px;"></span>
        <span>Buy&nbsp;gift&nbsp;card</span>
      </div>

      <div class="pluslink d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 10px; height: 10px;"></span>
        <span>Subscribe&nbsp;to&nbsp;PS&nbsp;Plus</span>
      </div>
    </div>
  </div>

  <!-- ......................SupportContainer......................... 60 -->
  <div class="support_container unseen">
    <div class="d-flex justify-content-center">
      <button class="supportlink btn"><img src="images/support.png" class="mx-4"><span class="d-block">Support</span></button>
      <button class="psnlink btn"><img src="images/psnstatus.png" class="mx-4"><span class="d-block">PSN Status</span></button>
    </div>
    <hr style="margin-top: 45px;">

    <!-- .....................SupportFooter..................... -->
    <div class="footer_container d-flex justify-content-center">

      <div class="accountlink d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 10px; height: 10px;"></span>
        <span>Account</span>
      </div>

      <div class="supportstorelink d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 10px; height: 10px;"></span>
        <span>Store</span>
      </div>

      <div class="tieredlink d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 10px; height: 10px;"></span>
        <span>Tiered&nbsp;Services</span>
      </div>

      <div class="supportgameslink d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 10px; height: 10px;"></span>
        <span>Games</span>
      </div>

      <div class="supporthardwarelink d-inline-block" style="cursor: pointer;">
        <span class="rounded-circle bg-primary d-inline-block me-2" style="width: 10px; height: 10px;"></span>
        <span>Hardware</span>
      </div>
    </div>
  </div>
</div>






<!-- ........................Header3........................... -->

<div class="header_3 container-fluid position-sticky top-0 bg-white header-shadow pt-2" style="position: relative; z-index: 100;">
  <div class="row">
    <div class="col-3 ms-2">
      <div class="d-flex align-items-start">
        <img src="images/psstorelogo.png" class="me-3" width="20px" height="30px" alt="">
        <p class="d-inline fs-5 mb-2"><span class="fw-bold">PlayStation</span>Store</p>
      </div>
    </div>


    <div class="col" id="list_buttons">
      <ul class="d-flex align-items-start p-0">
        <span class="storelink btn fw-bold">Latest</span>
        <span class="collectionlink btn fw-bold">Collections</span>
        <span class="dealslink btn fw-bold">Deals</span>
        <span class="ps5link btn fw-bold">PS5</span>
        <span class="subscriptionlink btn fw-bold">Subscriptions</span>
        <span class="browselink btn fw-bold">Browse</span>
      </ul>
    </div>

    <div id="carouselExample" class="col carousel slide" style="display: none;">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <ul class="d-flex align-items-start p-0">
            <span class="storelink btn fw-bold">Latest</span>
            <span class="collectionlink btn fw-bold">Collections</span>
            <span class="dealslink btn fw-bold">Deals</span>
            <span class="ps5link btn fw-bold">PS5</span>
            <span class="subscriptionlink btn fw-bold">Subscriptions</span>
            <span class="browselink btn fw-bold">Browse</span>
          </ul>
        </div>
      </div>
      <button class="carousel-control-prev unseen" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

  </div>
</div>
<script>
  $(document).ready(function() {
    $('#cartOffcanvas').on('show.bs.offcanvas', function() {
      $('body').addClass('overflow-hidden');
    });

    $('#cartOffcanvas').on('hidden.bs.offcanvas', function() {
      $('body').removeClass('overflow-hidden');
    });

    $.ajax({
      type: 'POST',
      url: 'check_login.php',
      dataType: 'json',
      success: function(response) {
        if (response.logged_in) {
          $('.wishlist, .cart').removeClass('unseen');
          $('.userProfile,.mwishlist').removeClass('navUnseen');
          $('.signIn_btn').addClass('unseen');
        } else {
          $('.wishlist, .cart').addClass('unseen');
          $('.userProfile,.mwishlist').addClass('navUnseen');
          $('.signIn_btn').removeClass('unseen');
        }
      }
    })


    $('.ps5link').click(function() {
      window.location.href = 'https://www.playstation.com/en-us/ps5/games/?smcid=other%3Aen-us%3Ablank%3Aprimary%20nav%3Amsg-games%3Aps5';
    })

    $('.ps4link').click(function() {
      window.location.href = 'https://www.playstation.com/en-us/ps4/ps4-games/?smcid=other%3Aen-us%3Ablank%3Aprimary%20nav%3Amsg-games%3Aps4';
    })

    $('.vrlink').click(function() {
      window.location.href = 'https://www.playstation.com/en-sg/ps-vr/';
    })

    $('.pluslink').click(function() {
      window.location.href = 'https://www.playstation.com/en-us/ps-plus/whats-new/?smcid=other%3Aen-us%3Ablank%3Aprimary%20nav%3Amsg-games%3Aps-plus';
    })

    $('.storelink').click(function() {
      window.location.href = 'https://store.playstation.com/en-us/pages/latest';
    })

    $('.indieslink').click(function() {
      window.location.href = 'https://www.playstation.com/en-us/games/indies/?smcid=store%3Aen-us%3Acategory-85448d87-aa7b-4318-9997-7d25f4d275a4-1%3Aprimary%20nav%3Amsg-games%3Aplaystation-indies';
    })

    $('.indieslink').click(function() {
      window.location.href = 'https://www.playstation.com/en-us/games/indies/?smcid=store%3Aen-us%3Acategory-85448d87-aa7b-4318-9997-7d25f4d275a4-1%3Aprimary%20nav%3Amsg-games%3Aplaystation-indies';
    })

    $('.4on5link').click(function() {
      window.location.href = 'https://www.playstation.com/en-au/support/games/ps5-backward-compatibility-games/';
    })

    $('.freeplaylink').click(function() {
      window.location.href = 'https://www.playstation.com/en-us/editorial/great-free-to-play-games-on-playstation-4/?';
    })

    $('.psonpclink').click(function() {
      window.location.href = 'https://www.playstation.com/en-us/games/pc-games/';
    })

    $('.dealofferlink').click(function() {
      window.location.href = 'https://store.playstation.com/en-sg/pages/deals';
    })

    $('.dealofferlink').click(function() {
      window.location.href = 'https://store.playstation.com/en-sg/pages/deals';
    })

    $('.ps4prolink').click(function() {
      window.location.href = 'https://www.playstation.com/en-sg/ps4/ps4-pro/';
    })

    $('.vr2link').click(function() {
      window.location.href = 'https://www.playstation.com/en-sg/ps-vr2/games/?smcid=pdc%3Aen-sg%3Aps-vr2-games%3Aprimary%20nav%3Amsg-games%3Aps-vr2';
    })

    $('.dualsenselink').click(function() {
      window.location.href = 'https://www.playstation.com/en-sg/accessories/dualsense-wireless-controller/?emcid=pa-co-508968&gad_source=1&gclid=CjwKCAjwrcKxBhBMEiwAIVF8rFynM1JRz5VYY8YbRMRPitCe2Hd7LDXBWhj5Kan0n0fw4608ymzB8hoCVEUQAvD_BwE&gclsrc=aw.ds';
    })

    $('.pulselink').click(function() {
      window.location.href = 'https://www.playstation.com/en-sg/accessories/pulse-3d-wireless-headset/';
    })

    $('.dualshocklink').click(function() {
      window.location.href = 'https://www.playstation.com/en-sg/accessories/dualshock-4-wireless-controller/';
    })

    $('.accessorieslink').click(function() {
      window.location.href = 'https://www.playstation.com/en-sg/accessories/';
    })

    $('.psstarlink').click(function() {
      window.location.href = 'https://www.playstation.com/en-us/playstation-stars/?smcid=pdc%3Aen-us%3Aps-plus%3Aprimary%20nav%3Amsg-services%3Aps-stars';
    })

    $('.5enterlink').click(function() {
      window.location.href = 'https://www.playstation.com/en-us/ps5/ps5-entertainment/?smcid=pdc%3Aen-us%3Aps-plus%3Aprimary%20nav%3Amsg-services%3Aps5-entertainment';
    })

    $('.4enterlink').click(function() {
      window.location.href = 'https://www.playstation.com/en-us/ps4/ps4-entertainment/?smcid=pdc%3Aen-us%3Aps-plus%3Aprimary%20nav%3Amsg-services%3Aps4-entertainment';
    })

    $('.bloglink').click(function() {
      window.location.href = 'https://blog.playstation.com/?smcid=pdc%3Aen-us%3Aps4-ps4-entertainment%3Aprimary%20nav%3Amsg-news%3Aps-blog';
    })

    $('.monthlink').click(function() {
      window.location.href = 'https://www.playstation.com/en-us/editorial/this-month-on-playstation/?smcid=pdc%3Aen-us%3Aps4-ps4-entertainment%3Aprimary%20nav%3Amsg-news%3Athis-month-on-playstation';
    })

    $('.competitionlink').click(function() {
      window.location.href = 'https://compete.playstation.com/en-sg/all/?smcid=pdc%3Aen-us%3Aps4-ps4-entertainment%3Aprimary%20nav%3Amsg-news%3Acompetition-center';
    })

    $('.accessibilitylink').click(function() {
      window.location.href = 'https://www.playstation.com/en-us/accessibility/?smcid=pdc%3Aen-us%3Aps4-ps4-entertainment%3Aprimary%20nav%3Amsg-news%3Aaccessibility';
    })

    $('.safetylink').click(function() {
      window.location.href = 'https://www.playstation.com/en-us/privacy-security-safety/?smcid=pdc%3Aen-us%3Aaccessibility%3Aprimary%20nav%3Amsg-news%3Aprivacy-safety';
    })

    $('.hardwarelink').click(function() {
      window.location.href = 'https://direct.playstation.com/en-us#';
    })

    $('.digitalgameslink').click(function() {
      window.location.href = 'https://www.playstation.com/en-sg/ps-plus/?emcid=pa-co-509027&gad_source=1&gclid=CjwKCAjwrcKxBhBMEiwAIVF8rL4ZiOCOgQBH8Ku_XtQ15bnmiRP-4w1p8iZ7Ykt37AOVFsSS58JuuhoCLnQQAvD_BwE&gclsrc=aw.ds';
    })

    $('.merchandiselink').click(function() {
      window.location.href = 'https://gear.playstation.com/Main/Splash';
    })

    $('.buyps5link').click(function() {
      window.location.href = 'https://direct.playstation.com/en-us/ps5?smcid=pdc%3Aen-us%3Aps-plus%3Aprimary%20nav%3Amsg-store%3Abuy-a-ps5';
    })

    $('.releaseslink').click(function() {
      window.location.href = 'https://store.playstation.com/en-sg/pages/latest';
    })

    $('.discountslink').click(function() {
      window.location.href = 'https://store.playstation.com/en-sg/pages/deals';
    })

    $('.giftcardlink').click(function() {
      window.location.href = 'https://www.playstation.com/en-us/playstation-gift-cards/?smcid=pdc%3Aen-us%3Aps-plus%3Aprimary%20nav%3Amsg-store%3Abuy-gift-card';
    })

    $('.supportlink').click(function() {
      window.location.href = 'https://www.playstation.com/en-us/support/?smcid=pdc%3Aen-us%3Aplaystation-gift-cards%3Aprimary%20nav%3Amsg-support%3Asupport';
    })

    $('.psnlink').click(function() {
      window.location.href = 'https://status.playstation.com/?smcid=pdc%3Aen-us%3Asupport-hardware%3Aprimary%20nav%3Amsg-support%3Apsn-status';
    })

    $('.accountlink').click(function() {
      window.location.href = 'https://www.playstation.com/en-us/support/account/?smcid=pdc%3Aen-us%3Asupport-hardware%3Aprimary%20nav%3Amsg-support%3Aaccount';
    })

    $('.supportstorelink').click(function() {
      window.location.href = 'https://www.playstation.com/en-us/support/store/?smcid=pdc%3Aen-us%3Asupport-hardware%3Aprimary%20nav%3Amsg-support%3Astore';
    })

    $('.tieredlink').click(function() {
      window.location.href = 'https://www.playstation.com/en-us/support/subscriptions/?smcid=pdc%3Aen-us%3Asupport-hardware%3Aprimary%20nav%3Amsg-support%3Atiered-services';
    })

    $('.supportgameslink').click(function() {
      window.location.href = 'https://www.playstation.com/en-us/support/games/?smcid=pdc%3Aen-us%3Asupport-hardware%3Aprimary%20nav%3Amsg-support%3Agames';
    })

    $('.supporthardwarelink').click(function() {
      window.location.href = 'https://www.playstation.com/en-us/support/hardware/?smcid=pdc%3Aen-us%3Asupport-games%3Aprimary%20nav%3Amsg-support%3Ahardware';
    })

    $('.collectionlink').click(function() {
      window.location.href = 'https://store.playstation.com/en-us/pages/collections';
    })

    $('.dealslink').click(function() {
      window.location.href = 'https://store.playstation.com/en-us/pages/deals';
    })

    $('.subscriptionlink').click(function() {
      window.location.href = 'https://store.playstation.com/en-us/pages/subscriptions';
    })

    $('.browselink').click(function() {
      window.location.href = 'https://store.playstation.com/en-us/pages/browse';
    })
  })
</script>