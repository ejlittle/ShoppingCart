<?php

    $connect = mysql_connect("","","") or die("Connection failed");
    $selectedDatabase = mysql_select_db("",$connect) or die("Database selected failed");

?>