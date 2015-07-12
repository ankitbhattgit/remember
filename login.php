<?php
error_reporting(1);
include 'functions.php';
if(loggedin()){
   header("Location: userarea.php");
    exit();
}

if(isset($_POST['login']))
{
      $username=$_POST['username'];
      $password=$_POST['password'];
    
    if(isset($_POST['rememberme']))
    {
    $rememberme=$_POST['rememberme'];
    }

    if($username && $password)
    {
        $login=mysql_query("SELECT * FROM users where username='$username'");
     
        while($row=mysql_fetch_assoc($login))
        {
            $db_password=$row['password'];
            if(md5($password)==$db_password)
            {
                $loginok=TRUE;
            }
            else
            {
                $loginok=FALSE;
            }
            if($loginok==TRUE)
            {
                if($rememberme=="on")
                {

                    setcookie("rememberme","remember",time()+ 7200);
                    setcookie("username",$username,time()+ 17200);
                    setcookie("password",$password,time()+ 17200);


                }
               elseif($rememberme=="")
                    {
                        $_SESSION['username']=$username;
                    }
                header("Location: userarea.php");
                exit();
            }
            else
            {

                die("incorrect username or password");
            }
        }

    }
    else
    {
        die("Please enter a username and password");

    }
}

?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    Username:<br>
    <input type="text" name="username" value="<?php echo $_COOKIE['username']; ?>"/><p/>
    Password:<br>
    <input type="password" name="password" value="<?php echo $_COOKIE['password']; ?>"/><p/>
    <input type="checkbox" name="rememberme">Remember Me<p/>
    <input type="submit" name="login" value="Log In">
</form>