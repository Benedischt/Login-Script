<?php
session_start();
if(!isset($_SESSION['id']))
{
    header('Location: index.php');
}

?>
<center><h1>Your Session has been created.</h1></center>
