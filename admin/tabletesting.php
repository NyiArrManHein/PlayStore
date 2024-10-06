<?php
    session_start();
    $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
    if($pageWasRefreshed ) {
        unset($_SESSION['crudSearch']);   
    }
    include('../db.php');
    include("../modal.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/PlayStore/css/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src=" https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../index.js"></script>
    <style>
        .wrapper{
            width: min(1100px, 100% - 3rem);
            margin-inline: auto;
        }

        table{
            width: 100%;
            border-collapse: collapse;
        }
        
        th,td{
            padding: 1rem;
        }

        .table_pagination li{
            display: inline-block;
            margin: 0 5px; 
            width: 45px;
            height: 45px;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            line-height: 45px;
            text-decoration: none;
            color: inherit;
            cursor: pointer;
        }

        .table_pagination li.active,
        .table_pagination li.numb:hover{
            border: 1px solid gray;
            background-color: rgb(60, 178, 218);
        }

        @media (max-width: 650px){
            th{
                display: none;
            }

            td{
                display: block;
                padding: 0.5rem 1rem;
            }

            #action_div{
                display: inline;
            }

            td::before{
                content: attr(data-cell) ": ";
                font-weight: 700;
                text-transform: capitalize;
            }

            td:first-child{
                padding-top: 2rem;
            }
            td:last-child{
                padding-bottom: 2rem;
            }
        }
    </style>
</head>
<body>
<div class="wrapper">
        <div class="d-flex justify-content-between">
            <p>Products</p>
            
            <button id="addgameBtn" class="btn" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#add_games_modal">
                <i id="add_btn" class="fa-solid fa-plus me-2"></i>Add</button>
        </div>

        <hr>

        <div id="search_container" class="d-flex justify-content-end">
            <button id="clearSearch" class="btn rounded-2 ms-3" style="background-color: #B6BAC2; padding: 11px; display:none;"><span id="clearSearch_txt" class="me-1"></span><img class="mb-1 ms-1" src="../images/xmark.PNG" width="15px" height="15px" alt=""></button>
            <input id="crud_search" class="form-control" style="max-width: 200px;" type="text" placeholder="Search">
        </div>
        
        <table id="product_table"></table>
        <div id="pagination_container">
        <div class="pagination d-flex justify-content-end align-items-center">
            <ul class="table_pagination">
            </ul>
        </div>
        </div>
    </div>

    <script>
         $(document).ready(function(){
            fetch();
        })

        const ulTag = document.querySelector(".table_pagination");
        // let totalPages = 0;
        
        function element(totalPages, page){
            let liTag = '';
            let activeLi;
            let beforePages = page - 1;
            let afterPages = page + 1;
            
          
          for(let pageLength = beforePages; pageLength <= afterPages; pageLength++){
                if(pageLength > totalPages){
                    continue;
                }
                if(pageLength == 0){
                    pageLength = pageLength + 1;
                }
                
                if(page == pageLength){
                    activeLi = "active";
                }else{
                    activeLi = "";
                }
                // liTag += `<li class="numb ${activeLi}" onclick="element(totalPages, ${pageLength})"><a href="index.php?id=${pageLength}"><span>${pageLength}</span></a></li>`
                liTag += `<li id="${pageLength}" class="numb ${activeLi}" onclick="element(totalPages, ${pageLength})"><span>${pageLength}</span></li>`;
            }
        
            if(page < totalPages - 1){
                if(page < totalPages - 2){
                    liTag += `<li class="dots"><span>...</span></li>`;
                }
                // liTag += `<li class="numb" onclick="element(totalPages, ${totalPages})"><a href="index.php?id=${totalPages}"><span>${totalPages}</span></a></li>`
                liTag += `<li id="${totalPages}" class="numb" onclick="element(totalPages, ${totalPages})"><span>${totalPages}</span></li>`;
            }
        
           
            ulTag.innerHTML = liTag;
            $('li').click(function(){
              let id = $(this).attr('id');
              $.ajax({
                url:"productpagination.php",
                method:"POST",
                data:{id},
                success:function(result){
                  $('#product_table').html(result);
                }
              })
            })
        }
        // element(totalPages,1);

        function validateAndStore(){
            console.log("validateAndStore function called");
             var g_title = $('#game_title').val().trim();
             var g_price = $('#price').val().trim();
             var g_publisher = $('#publisher').val().trim();
             var g_players = $('#players').val().trim();
             var g_gameLegal = $('#game_legal').val().trim();
             var g_footer = $('#footer').val().trim();

             validate(game_title,title_validate);
             validate(price,price_validate);
             validate(publisher,publisher_validate);
             validate(players,players_validate);
             validate(game_legal,game_legal_validate);
             validate(footer,footer_validate);
            
            if(g_title!== '' && g_price!== '' && g_publisher!== '' && g_players!== '' && g_gameLegal!== '' && g_footer!== ''){
                store();
            }
        }

        function validateAndUpdate(){
            var g_title = $('#game_title').val().trim();
            var g_price = $('#price').val().trim();
            var g_publisher = $('#publisher').val().trim();
            var g_players = $('#players').val().trim();
            var g_gameLegal = $('#game_legal').val().trim();
            var g_footer = $('#footer').val().trim();

            validate(game_title,title_validate);
            validate(price,price_validate);
            validate(publisher,publisher_validate);
            validate(players,players_validate);
            validate(game_legal,game_legal_validate);
            validate(footer,footer_validate);

             if(g_title!== '' && g_price!== '' && g_publisher!== '' && g_players!== '' && g_gameLegal!== '' && g_footer!== ''){
                update();
            }
        }

        function validate(inputId, pId){
            var input = $(inputId).val().trim();
           
            console.log("Input value:", input);
            if(input === ''){
                console.log("Empty input detected");
                $(pId).css('display','block');
            }

            $(inputId).on('input', function(){
                var eventInput = $(inputId).val().trim();
                if(eventInput === ''){
                    $(pId).css('display','block');
                }else{
                    $(pId).css('display','none');
                }
            })
        }



        function store(){
            var title = $('#game_title').val();
            var price = $('#price').val();
            var platform = $('input[name="radio"]:checked').val();
            var inGamePurchases = $('#in_game_purchases').is(':checked') ? 1 : 0;
            var publisher = $('#publisher').val();
            var esrb = $('#esrb').val();
            var genre = $('#genre').val();
            var online_status = $('#online').val();
            var players = $('#players').val();
            var onlinePlayerCount  = $('#ps_plus').val();
            var thumbnailInput = $('#thumbnail')[0];
            var thumbnailFile = thumbnailInput.files[0];
            var posterInput = $('#poster')[0];
            var posterFile = posterInput.files[0];
            var gameLegal = $('#game_legal').val();
            var footer = $('#footer').val();
            var formData = new FormData();

            formData.append('title',title);
            formData.append('price',price);
            formData.append('platform',platform);
            formData.append('inGamePurchases',inGamePurchases);
            formData.append('publisher',publisher);
            formData.append('esrb',esrb);
            formData.append('genre',genre);
            formData.append('online_status',online_status);
            formData.append('players',players);
            formData.append('onlinePlayerCount',onlinePlayerCount);
            formData.append('gameLegal',gameLegal);
            formData.append('footer',footer);

            // var otherData = {
            //     title,price,console,inGamePurchases,publisher,esrb,genre,online_status,
            //     players,onlinePlayerCount,gameLegal,footer
            // }

            // var otherDataJson = JSON.stringify(otherData);

            if(thumbnailFile){
                formData.append('thumbnail', thumbnailFile);
            }
            
            if(posterFile){
                formData.append('poster',posterFile);
            }
            

            $.ajax({
                url:"crud.php",
                method:"POST",
                data:formData,
                contentType: false,
                processData: false,
                success:function(){
                    fetch();
                    $('#add_games_modal').modal('hide');
                }
            })
            
        }

        function update(){
            var uid = $('#game_id').val();
            var utitle = $('#game_title').val();
            var uprice = $('#price').val();
            var uplatform = $('input[name="radio"]:checked').val();
            var uinGamePurchases = $('#in_game_purchases').is(':checked') ? 1 : 0;
            var upublisher = $('#publisher').val();
            var uesrb = $('#esrb').val();
            var ugenre = $('#genre').val();
            var uonline_status = $('#online').val();
            var uplayers = $('#players').val();
            var uonlinePlayerCount  = $('#ps_plus').val();
            var uthumbnailInput = $('#thumbnail')[0];
            var uthumbnailFile = uthumbnailInput.files[0];
            var uthumbnail_txt= $('#thumbnail_txt').val();
            var uposterInput = $('#poster')[0];
            var uposterFile = uposterInput.files[0];
            var uposter_txt = $('#poster_txt').val();
            var ugameLegal = $('#game_legal').val();
            var ufooter = $('#footer').val();
            var formData = new FormData();

            formData.append('uid',uid);
            formData.append('utitle',utitle);
            formData.append('uprice',uprice);
            formData.append('uplatform',uplatform);
            formData.append('uinGamePurchases',uinGamePurchases);
            formData.append('upublisher',upublisher);
            formData.append('uesrb',uesrb);
            formData.append('ugenre',ugenre);
            formData.append('uonline_status',uonline_status);
            formData.append('uplayers',uplayers);
            formData.append('uonlinePlayerCount',uonlinePlayerCount);
            formData.append('uthumbnailTxt',uthumbnail_txt);
            formData.append('uposterTxt',uposter_txt);
            formData.append('ugameLegal',ugameLegal);
            formData.append('ufooter',ufooter);

            if(uthumbnailFile){
                formData.append('uthumbnail', uthumbnailFile);
            }
            
            if(uposterFile){
                formData.append('uposter', uposterFile);
            }

            $.ajax({
               url:"crud.php",
               method:"POST",
               data:formData,
               contentType: false,
               processData: false,
               success:function(){
                fetch();
                $('#add_games_modal').modal('hide');
               }
            })

            
        }

        function fetch(){
            $.ajax({
                url:"crud.php",
                method:"POST",
                data:{"select":1},
                success:function(result){
                    $('#product_table').html(result);
                }
            })
        }

        function destroy(id){
            $.ajax({
                url:"crud.php",
                method:"POST",
                data:{id},
                success:function(){
                    fetch();
                }
            })
        }

        function edit(eid){
            $.ajax({
                url:"crud.php",
                method:"POST",
                data:{eid},
                dataType:"json",
                success:function(result){
                    $('#game_id').val(result.id);
                    $('#game_title').val(result.title);
                    $('#price').val(result.price);
                    if(result.console == 0){
                        $('#ps4').prop('checked',true);
                    }else{
                        $('#ps5').prop('checked',true);
                    }
                    if(result.purchases == 1){
                        $('#in_game_purchases').prop('checked',true);
                    }else{
                        $('#in_game_purchases').prop('checked',false);
                    }
                    
                    $('#publisher').val(result.publisher);
                    $('#esrb').val(result.esrb);
                    $('#genre').val(result.genre);
                    $('#online').val(result.online_status);
                    $('#players').val(result.players);
                    $('#ps_plus').val(result.online_players);
                    $('#thumbnail_txt').val(result.thumbnail);
                    $('#thumbnailPreview').attr('src', '../images/' + result.thumbnail);
                    $('#poster_txt').val(result.poster);
                    $('#posterPreview').attr('src', '../images/' + result.poster);
                    $('#game_legal').val(result.legal_info);
                    $('#footer').val(result.footer);
                    $('#cu_btn').attr('onclick','validateAndUpdate()');
                }
            })
        }

    $('#addgameBtn').click(function(){
        $('#cu_btn').attr('onclick','validateAndStore()');
    })

    $('#crud_search').keypress(function(event){
        if(event.key === "Enter"){
        var crudSearch = $('#crud_search').val().trim();
        var clearSearch = crudSearch.substring(0,10);
        $('#search_container').removeClass('justify-content-end').addClass('justify-content-between');
        $('#clearSearch').css('display','block');

        $('#clearSearch_txt').text(clearSearch);
        $.ajax({
              url:"../search.php",
              method:"POST",
              data:{crudSearch},
              success:function(result){
                $('#product_table').html(result);
              }
            })
    }
    })

    $('#clearSearch').click(function(){
        $.ajax({
              url:"clearSearch.php",
              method:"POST",
              data:{"clearSearch":1},
              success:function(){
                fetch();
              }
            })
        $('#crud_search').val('');
        $('#search_container').removeClass('justify-content-between').addClass('justify-content-end');
        $('#clearSearch').css('display','none');
        $('#pagination_container').css('display','block');
    })

    function NoResultFound(isSearch){
    if(isSearch == 1){
        $('#product_table').removeAttr('class');
      }else{
        $('#product_table').attr('class','d-flex justify-content-center align-items-center');
        $('#product_table').html('<div class="d-flex flex-column"><img src="images/noresultfound.webp" width="289px" height="289px" alt=""><p class="text-center">No results found</p></div>');
      }
    }
</script>
</body>
</html>