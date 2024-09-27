<?php
$dir_name = "/" . basename(str_replace(array("pages", "cars"), "", __DIR__)) . "/";
set_include_path($_SERVER['DOCUMENT_ROOT'] . $dir_name . "includes");
