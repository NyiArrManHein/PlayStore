$(document).ready(function () {
  // .................Upbar..................
  var lastClickedButton = null;
  $(
    "#games_btn,#hardware_btn,#services_btn,#news_btn,#shop_btn,#support_btn"
  ).click(function () {
    $("body").css("overflow", "hidden");
    var currentButton = $(this).attr("id");
    if (currentButton == "games_btn") {
      $("#up1").toggleClass("rotate");
      $("#up2,#up3,#up4,#up5,#up6").removeClass("rotate");
      $("#games_fill_logo,#games_unfill_logo").toggleClass("unseen");
      $(
        "#hardware_fill_logo,#services_fill_logo,#news_fill_logo,#shop_fill_logo,#support_fill_logo"
      ).addClass("unseen");
      $(
        "#hardware_unfill_logo,#services_unfill_logo,#news_unfill_logo,#shop_unfill_logo,#support_unfill_logo"
      ).removeClass("unseen");
      $(".games_container").removeClass("unseen");
      $(
        ".hardware_container,.services_container,.news_container,.shop_container,.support_container"
      ).addClass("unseen");
    } else if (currentButton == "hardware_btn") {
      $("#up2").toggleClass("rotate");
      $("#up1,#up3,#up4,#up5,#up6").removeClass("rotate");
      $("#hardware_fill_logo,#hardware_unfill_logo").toggleClass("unseen");
      $(
        "#games_fill_logo,#services_fill_logo,#news_fill_logo,#shop_fill_logo,#support_fill_logo"
      ).addClass("unseen");
      $(
        "#games_unfill_logo,#services_unfill_logo,#news_unfill_logo,#shop_unfill_logo,#support_unfill_logo"
      ).removeClass("unseen");
      $(".hardware_container").removeClass("unseen");
      $(
        ".games_container,.services_container,.news_container,.shop_container,.support_container"
      ).addClass("unseen");
    } else if (currentButton == "services_btn") {
      $("#up3").toggleClass("rotate");
      $("#up1,#up2,#up4,#up5,#up6").removeClass("rotate");
      $("#services_fill_logo,#services_unfill_logo").toggleClass("unseen");
      $(
        "#games_fill_logo,#hardware_fill_logo,#news_fill_logo,#shop_fill_logo,#support_fill_logo"
      ).addClass("unseen");
      $(
        "#games_unfill_logo,#hardware_unfill_logo,#news_unfill_logo,#shop_unfill_logo,#support_unfill_logo"
      ).removeClass("unseen");
      $(".services_container").removeClass("unseen");
      $(
        ".hardware_container,.games_container,.news_container,.shop_container,.support_container"
      ).addClass("unseen");
    } else if (currentButton == "news_btn") {
      $("#up4").toggleClass("rotate");
      $("#up1,#up2,#up3,#up5,#up6").removeClass("rotate");
      $("#news_fill_logo,#news_unfill_logo").toggleClass("unseen");
      $(
        "#games_fill_logo,#hardware_fill_logo,#services_fill_logo,#shop_fill_logo,#support_fill_logo"
      ).addClass("unseen");
      $(
        "#games_unfill_logo,#hardware_unfill_logo,#services_unfill_logo,#shop_unfill_logo,#support_unfill_logo"
      ).removeClass("unseen");
      $(".news_container").removeClass("unseen");
      $(
        ".hardware_container,.services_container,.games_container,.shop_container,.support_container"
      ).addClass("unseen");
    } else if (currentButton == "shop_btn") {
      $("#up5").toggleClass("rotate");
      $("#up1,#up2,#up3,#up4,#up6").removeClass("rotate");
      $("#shop_fill_logo,#shop_unfill_logo").toggleClass("unseen");
      $(
        "#games_fill_logo,#hardware_fill_logo,#services_fill_logo,#news_fill_logo,#support_fill_logo"
      ).addClass("unseen");
      $(
        "#games_unfill_logo,#hardware_unfill_logo,#services_unfill_logo,#news_unfill_logo,#support_unfill_logo"
      ).removeClass("unseen");
      $(".shop_container").removeClass("unseen");
      $(
        ".hardware_container,.services_container,.news_container,.games_container,.support_container"
      ).addClass("unseen");
    } else if (currentButton == "support_btn") {
      $("#up6").toggleClass("rotate");
      $("#up1,#up2,#up3,#up4,#up5").removeClass("rotate");
      $("#support_fill_logo,#support_unfill_logo").toggleClass("unseen");
      $(
        "#games_fill_logo,#hardware_fill_logo,#services_fill_logo,#news_fill_logo,#shop_fill_logo"
      ).addClass("unseen");
      $(
        "#games_unfill_logo,#hardware_unfill_logo,#services_unfill_logo,#news_unfill_logo,#shop_unfill_logo"
      ).removeClass("unseen");
      $(".support_container").removeClass("unseen");
      $(
        ".hardware_container,.services_container,.news_container,.shop_container,.games_container"
      ).addClass("unseen");
    }

    if (currentButton == lastClickedButton) {
      $("#upbar").toggleClass("open");
      $("#sidebar_container").toggleClass("open");
    } else {
      $("#upbar").addClass("open");
      $("#sidebar_container").addClass("open");
    }
    lastClickedButton = currentButton;
  });

  // ...............Hamburger..................
  $("#hamburger_btn").click(function () {
    $("body").css("overflow", "hidden");
    $("#hamburger_btn,#close_btn").toggleClass("unseen");
    $(".header_3,.game_cards,#sidebar_btn_gp").toggleClass("unseen");
  });

  // ...............Close..................
  $("#close_btn").click(function () {
    $("body").css("overflow-y", "scroll");
    $("#hamburger_btn,#close_btn").toggleClass("unseen");
    $(".header_3,.game_cards,#sidebar_btn_gp").toggleClass("unseen");
  });

  // ...............SidebarClose..................
  $(".sidebar_close_btn").click(function () {
    $("#sidebar_container").removeClass("open");
    $(
      "#games_fill_logo,#hardware_fill_logo,#services_fill_logo,#news_fill_logo,#shop_fill_logo,#support_fill_logo"
    ).addClass("unseen");
    $(
      "#games_unfill_logo,#hardware_unfill_logo,#services_unfill_logo,#news_unfill_logo,#shop_unfill_logo,#support_unfill_logo"
    ).removeClass("unseen");
  });

  // ...............Carousel..................
  $(".carousel-control-next").on("click", function () {
    $(".carousel-inner").animate({ scrollLeft: 300 }, 600);
    $(".carousel-control-next").css("display", "none");
    $(".carousel-control-prev").css("display", "block");
  });

  $(".carousel-control-prev").on("click", function () {
    $(".carousel-inner").animate({ scrollLeft: -300 }, 600);
    $(".carousel-control-next").css("display", "block");
    $(".carousel-control-prev").css("display", "none");
  });

  // ...............LogInSection..................
  // $('#login_nextbtn,#login_backbtn').click(function(){
  //     $('.login_email').toggleClass('border-none');
  //     $('.login_pwd,#login_backbtn,#signin_btn').toggleClass('unseen');
  //     $('#login_nextbtn,.create_acc_btn').toggleClass('unseen');
  //    })

  // ...............GameCardsHover..................
  $(".test_1").hover(
    function () {
      $(this).children("img").addClass("image-border");
    },
    function () {
      $(this).children("img").removeClass("image-border");
    }
  );

  // ...............SortandFilter..................
  $("#Best_Selling,#a_z,#z_a,#Old_New,#New_Old,#Low_High,#High_Low").click(
    function () {
      var current = $(this).attr("id");
      $.ajax({
        url: "sorting.php",
        method: "POST",
        data: { current },
        success: function (result) {
          $("#games").html(result);
        },
      });
    }
  );

  $("#Action,#Shooter,#RPG,#Sport,#Racing,#Horror,#Fighting").click(
    function () {
      var genre = $(this).attr("id");
      $.ajax({
        url: "filtering.php",
        method: "POST",
        data: { genre },
        success: function (result) {
          $("#games").html(result);
        },
      });
    }
  );

  $("#thumbnail").change(function (event) {
    if (event.target.files && event.target.files[0]) {
      var x = URL.createObjectURL(event.target.files[0]);
      $("#thumbnailPreview").attr("src", x);
    } else {
      $("#thumbnailPreview").attr("src", "../images/noimage.png");
    }
  });

  $("#poster").change(function (event) {
    if (event.target.files && event.target.files[0]) {
      var y = URL.createObjectURL(event.target.files[0]);
      $("#posterPreview").attr("src", y);
    } else {
      $("#posterPreview").attr("src", "../images/noimage.png");
    }
  });

  $("#closeModalBtn, #closeModalCrossBtn").on("click", function () {
    $(
      "#game_id,#game_title,#price,#publisher,#players,#ps_plus,#thumbnail_txt,#poster_txt,#game_legal,#footer"
    ).val("");
    $("#ps4").prop("checked", true);
    $("#in_game_purchases").prop("checked", false);
    $("#esrb,#genre,#online").val("1");
    $("#thumbnailPreview,#posterPreview").attr("src", "../images/noimage.png");
    $(
      "#title_validate,#price_validate,#publisher_validate,#players_validate,#game_legal_validate,#footer_validate"
    ).css("display", "none");
  });
});
