<?php
session_name("clients");
session_start();
//thwarts session fixation attacks
session_regenerate_id();

if(isset($_SESSION["customer_session"])){
     echo "<script> window.open('clients/home.php','_self')</script>";

}