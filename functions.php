<?php
session_start();
mysql_connect('localhost','root','');
mysql_select_db('remember') or die();

//login function
function loggedin()
{
    if(isset($_SESSION['username']) || isset($_COOKIE['rememberme']))
    {
        $loggedin = TRUE;
        return $loggedin;
    }
}
?>