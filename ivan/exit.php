<?php

session_start();
//$_SESSION['name'] = null;
unset($_SESSION['name']);
header("Location: ./index.php");
require "includes/func.php";
//logout();
