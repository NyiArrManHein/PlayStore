<?php
if (!isset($_GET['manageOrder'])) {
    header("location:../index.php");
}
?>
<link rel="stylesheet" href="../styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src=" https://code.jquery.com/jquery-3.7.1.min.js"></script>
<style>
    #wrapper {
        width: min(1100px, 100% - 3rem);
        margin-inline: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        text-align: start;
    }

    th,
    td {
        padding: 1rem;
    }

    @media (max-width: 650px) {
        th {
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
<?php
include('../db.php');
$sql = "SELECT order_games.id,order_games.total_items,order_games.total_price, 
        users.name,users.email FROM order_games INNER JOIN users ON order_games.user_id=users.id";
$query = mysqli_query($conn, $sql);
?>
<div id="wrapper">
    <table id="orderTable"></table>
</div>

<script>
    $(document).ready(function() {

        checkForNewOrders();

        function checkForNewOrders() {
            $.ajax({
                url: 'check_orders.php',
                type: 'GET',
                success: function(response) {
                    $('#orderTable').html(response);
                }
            });
        }



        // checkForNewOrders();
        // setInterval(checkForNewOrders, 2000);

        $(document).on('click', '#approveOrder,#cancelOrder', function() {
            var value = $(this).closest('tr').find('.orderId').val();
            var btnId = $(this).attr('id');
            var requestData = {};

            if (btnId === 'approveOrder') {
                requestData = {
                    'approve': 1,
                    'value': value
                };
            } else if (btnId === 'cancelOrder') {
                requestData = {
                    'cancel': 1,
                    'value': value
                };
            }
            $.ajax({
                url: 'approveOrder.php',
                method: 'POST',
                data: requestData,
                success: function() {
                    checkForNewOrders();
                }
            })

        })
    })
</script>