<?php
if (!isset($_GET['wish'])) {
    header("location:index.php");
}
session_start();
unset(
    $_SESSION["sort"],
    $_SESSION['filter'],
    $_SESSION['current'],
    $_SESSION["page_id"],
    $_SESSION['genre'],
    $_SESSION['filtering_page'],
    $_SESSION['pagination_sql'],
    $_SESSION['sorting_sql'],
    $_SESSION['filtering_sql'],
    $_SESSION['clear_sortfilter'],
    $_SESSION['searchValue'],
    $_SESSION['search_sql'],
    $_SESSION['search_pagination'],
    $_SESSION['search_page']
);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        #wHeader {
            box-shadow: 0px 4px 4px #ECECEC;
        }

        #wCard {
            max-width: 85%;
            margin: 0 auto;
            max-height: 108px;
        }
    </style>
</head>

<body style="background-color: #F5F7FA;">
    <div style="background-color: white;" id="wHeader" class="p-4 mb-5">Wishlist</div>


    <div id="wCard"></div>

    <script>
        $(document).ready(function() {

            fetch();

            function fetch() {
                $.ajax({
                    url: 'wish.php',
                    method: 'POST',
                    data: {
                        'select': 1
                    },
                    success: function(result) {
                        $('#wCard').html(result);
                    }
                })
            }

            $(document).on('click', '.wishDelete', function() {
                var wishInput = $(this).closest('.deleteContainer').find('.wishid').val();

                $.ajax({
                    url: 'wish.php',
                    method: 'POST',
                    data: {
                        'delete': 1,
                        'value': wishInput
                    },
                    success: function(result) {
                        fetch();
                    }
                })
            })
        })
    </script>
</body>

</html>