<?php
include('../db.php');
if (isset($_POST['select'])) {
    $sql = mysqli_query($conn, "SELECT * FROM users ORDER BY signup_date DESC");
    echo '<tr><th>Photo</th><th>Name</th><th>Email</th><th>SignupDate</th><th>Action</th></tr>';
    while ($row = mysqli_fetch_assoc($sql)) {
        echo '<tr><td data-cell="Photo"><img src="../images/' . $row['photo'] . '" width="70px" alt=""></td><td data-cell="Name">' . $row['name'] .
            '</td><td data-cell="Email">' . $row['email'] . '</td><td data-cell="SignupDate">' . $row['signup_date'] .
            '</td><td data-cell="Action"><i class="userDelete fa-solid fa-trash" style="width: 33px; height: 33px; padding: 9px; cursor: pointer;"></i>
             <input type="hidden" class="userId" value="' . $row['id'] . '"></td>
             </tr>';
    }
}

if (isset($_POST['deleteUser'])) {
    $userId = $_POST['value'];
    $deletesql = mysqli_query($conn, "DELETE FROM users WHERE id='$userId'");
}
