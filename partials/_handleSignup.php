<?php
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    include '_dbconnect.php';
    $email = $_POST['signupEmail'];
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['signupcPassword'];
    // Check weather email already exists
    $existsql = "SELECT * FROM `users` WHERE  user_email = '$email'";
    $result = mysqli_query($conn, $existsql);
    $numofrows = mysqli_num_rows($result);
    if ($numofrows>0)
    {
        $showerror = "email already exist";
    }
    else
    {
        if ($pass == $cpass)
        {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `password`) VALUES ('$email', '$hash')";
            $result = mysqli_query($conn, $sql);
            if ($result)
            {
                $showalert = true;
                header("Location: /forum/index.php?signupsuccess=true");
                exit();
            }
        }
        else
        {
            $showerror = "password do not match";
        }
    }
    header("Location: /forum/index.php?signupsuccess=false&error=$showerror");

}

?>