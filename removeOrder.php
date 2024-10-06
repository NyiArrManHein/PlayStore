<?php
session_start();
$totalPrice = 0;
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $numofOrders = count($_SESSION['cart']) - 1;
    if ($numofOrders == 0) {
        unset($_SESSION['cart']);
    }

    if ($numofOrders != 0) {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['id'] == $id) {
                unset($_SESSION['cart'][$key]);
            }
        }

        foreach ($_SESSION['cart'] as $key => $value) {
            $totalPrice = $totalPrice + $value['price'];
        }
    }


    if (isset($_SESSION['cart']) && $numofOrders != 0) {

        echo '<table class="table table-bordered mt-3"><tr><th>Photo</th><th>Title</th><th>Esrb</th><th>Date</th><th>Price</th><th>Action</th></tr>';
        $output = '';
        foreach ($_SESSION['cart'] as $key => $value) {
            $output .= '<tr><td data-cell="Photo"><img src="images/' . $value['thumbnail'] . '" width="80px"></td>
                <td data-cell="Title">' . $value['title'] . '</td>';
            if ($value['esrb'] == 1) {
                $output .= '<td data-cell="Esrb"><img src="images/e.png" width="45px" height="64px" alt=""></td>';
            } elseif ($value['esrb'] == 2) {
                $output .= '<td data-cell="Esrb"><img src="images/e10.png" width="45px" height="64px" alt=""></td>';
            } elseif ($value['esrb'] == 3) {
                $output .= '<td data-cell="Esrb"><img src="images/t.png" width="45px" height="64px"></td>';
            } elseif ($value['esrb'] == 4) {
                $output .= '<td data-cell="Esrb"><img src="images/M.svg" width="45px" height="64px"></td>';
            }

            $output .= '<td data-cell="Date">' . $value['date'] . '</td><td data-cell="Price">' . $value['price'] . '</td><td data-cell="Delete"><img src="images/delete.png" class="remove_order" id="' . $value['id'] . '" style="cursor: pointer;" alt=""></td></tr>';
        }
        $output .= '<tr><td id="totalspan" colspan="4" class="text-end">Total</td><td data-cell="Total">' . $totalPrice . '</td><td data-cell="Order"><button id="orderBtn" class="btn bg-black text-white">Order</button></td></tr></table>';
        echo $output;
    } else {
        echo '<div class="d-flex justify-content-center align-items-center vh-100">
                <div class="d-flex flex-column">
                    <img src="images/emptycart.jpg" width="200px" height="200px" alt="">
                     <p class="text-center">The cart is empty</p>
                </div>
              </div>';
    }
}
