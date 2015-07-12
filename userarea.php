<?php
include 'functions.php';
if(!loggedin())
{
    header("Location: login.php");
    exit();
}
?>

<?php echo 'Hello  '. $_SESSION['username'];?>

<p><a href="logout.php">Logout </a></p>