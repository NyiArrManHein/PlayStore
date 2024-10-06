<?php
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
$totalPrice = 0;
$numOrders = 0;

if (!isset($_GET['cart'])) {
    header("location:index.php");
}

if (isset($_SESSION['cart'])) {
    $numOrders = count($_SESSION['cart']);

    foreach ($_SESSION['cart'] as $key => $value) {
        $totalPrice = $totalPrice + $value['price'];
    }
}

if ($numOrders == 0) {
    unset($_SESSION['cart']);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        .wrapper {
            width: min(1100px, 100% - 3rem);
            margin-inline: auto;
        }

        table {
            width: 100%;
            border: 1px solid;
            border-collapse: collapse;
        }

        th {
            text-align: start;
        }

        /* th,
        td {
            padding: 1rem;
            border: 1px solid;
            border-collapse: collapse;
        } */

        @media (max-width: 650px) {
            /* table,th,td{
        border: none;
      } */

            th,
            #totalspan {
                display: none;
            }

            td {
                display: block;
                padding: 0.5rem 1rem;
            }

            td::before {
                content: attr(data-cell) ": ";
                font-weight: 700;
                word-spacing: 20px;
            }

            td:first-child {
                padding-top: 2rem;
            }

            td:last-child {
                padding-bottom: 2rem;
            }
        }
    </style>
</head>

<body>

    <?php if (isset($_SESSION['cart'])) { ?>
        <div id="wrapperContainer" class="wrapper">
            <img src="images/psnstatus.png" class="" width="45px" height="45px">
            <span class="fw-bold text-secondary">SONY</span>
            <div>
                <table class="table table-bordered mt-3">
                    <tr>
                        <th>Photo</th>
                        <th>Title</th>
                        <th>Esrb</th>
                        <th>Date</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                        <tr>
                            <td data-cell="Photo"><img src="images/<?php echo $value['thumbnail']; ?>" width="80px"></td>
                            <td data-cell="Title"><?php echo $value['title']; ?></td>
                            <?php if ($value['esrb'] == 1) { ?>
                                <td data-cell="Esrb"><img src="images/e.png" width="45px" height="64px" alt=""></td>
                            <?php } elseif ($value['esrb'] == 2) { ?>
                                <td data-cell="Esrb"><img src="images/e10.png" width="45px" height="64px" alt=""></td>
                            <?php } elseif ($value['esrb'] == 3) { ?>
                                <td data-cell="Esrb"><img src="images/t.png" width="45px" height="64px"></td>
                            <?php } elseif ($value['esrb'] == 4) { ?>
                                <td data-cell="Esrb"><img src="images/M.svg" width="45px" height="64px"></td>
                            <?php } ?>
                            <td data-cell="Date"><?php echo $value['date']; ?></td>
                            <td data-cell="Price"><?php echo $value['price']; ?></td>
                            <td data-cell="Delete"><img src="images/delete.png" class="remove_order" id="<?php echo $value['id']; ?>" style="cursor: pointer;" alt=""></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td id="totalspan" colspan="4" class="text-end">Total</td>
                        <td data-cell="Total"><?php echo $totalPrice; ?></td>
                        <td data-cell="Order"><button id="orderBtn" class="btn bg-black text-white">Order</button></td>
                    </tr>
                </table>
            </div>
        </div>

    <?php } else { ?>

        <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="d-flex flex-column">
                <img src="images/emptycart.jpg" width="200px" height="200px" alt="">
                <p class="text-center">The cart is empty</p>
            </div>
        </div>



    <?php } ?>

    <script>
        $(document).on('click', '.remove_order', function() {
            let id = $(this).attr('id');
            $.ajax({
                url: "removeOrder.php",
                method: "POST",
                data: {
                    id
                },
                success: function(result) {
                    $('#wrapperContainer').html(result);
                }
            })
        })

        $(document).on('click', '#orderBtn', function() {
            $.ajax({
                url: "order.php",
                method: "POST",
                data: {
                    "order": 1
                },
                success: function(result) {
                    $('#wrapperContainer').html(result);
                }
            })
        })
    </script>
</body>

</html>