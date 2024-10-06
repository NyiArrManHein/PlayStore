<?php
    session_start();
    if(isset($_POST['clearSearch'])){
        unset($_SESSION['crudSearch']);
    }
?>