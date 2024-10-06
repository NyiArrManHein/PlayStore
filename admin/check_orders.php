<?php
include('../db.php');
$sql = "SELECT order_games.id,order_games.total_items,order_games.total_price,order_games.purchased_date,order_games.ispurchased, 
            users.name,users.email,users.photo FROM order_games INNER JOIN users ON order_games.user_id=users.id";
$query = mysqli_query($conn, $sql);
echo ' <tr><th>Photo</th><th>Name</th><th>Email</th><th>Total(items)</th><th>Total(price)</th><th>PurchasedDate</th><th>Action</th></tr>';
while ($row = mysqli_fetch_assoc($query)) {
    $result = '';
    $result .= '<tr><td data-cell="Photo"><img src="../images/' . $row['photo'] . '" width="70px"></td><td data-cell="Name">' . $row['name'] . '</td><td data-cell="Email">' . $row['email'] . '</td><td data-cell="Total(items)">' . $row['total_items'] .
        '</td><td data-cell="Total(price)">' . $row['total_price'] . '</td><td data-cell="PurchasedDate">' . $row['purchased_date'] . '</td>';

    if ($row['ispurchased'] == 0) {
        $result .= '<td data-cell="Action"><button id="approveOrder" style="margin-right: 10px; background-color: cornflowerblue;" class="btn">Approve</button>
        <button id="cancelOrder" class="btn bg-danger">Cancel</button><input type="hidden" class="orderId" value="' . $row['id'] . '"></td></tr>';
    } elseif ($row['ispurchased'] == 1) {
        $result .= '<td data-cell="Action"><button style="margin-right: 10px; background-color: cornflowerblue;" class="btn">Approved</button>
        </td></tr>';
    } elseif ($row['ispurchased'] == 2) {
        $result .= '<td data-cell="Action"><button class="btn bg-danger">Canceled</button></td></tr>';
    }
    // echo '<tr><td>' . $row['name'] . '</td><td>' . $row['email'] . '</td><td>' . $row['total_items'] .
    //     '<td>' . $row['total_price'] . '<td><button id="approveOrder" style="margin-right: 10px; background-color: cornflowerblue;" class="btn">Approve</button>
    //      <button id="cancelOrder" class="btn bg-danger">Cancel</button></td><td><input class="orderId" value="' . $row['id'] . '"></td></tr>';
    echo $result;
}
