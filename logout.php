<?php

    setcookie("isConnected", "", time() - 3600, "/");
    header("Location: connexion.php");
    exit();