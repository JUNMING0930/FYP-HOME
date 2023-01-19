<?php

    if(!isset($_SESSION['Name']))
    {
        header("Location: index.php");
    }
?>