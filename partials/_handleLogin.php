<?php 
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    include '_dbconnect.php';
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPass'];
    $sql = "SELECT * FROM `users` WHERE user_email = '$email'";
    $result = mysqli_query($conn, $sql);
    $numofrows = mysqli_num_rows($result);
    if ($numofrows == 1)
    {
        $row = mysqli_fetch_assoc($result);

        
        if (password_verify($password, $row['password']))
        {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['useremail'] = $email;
            
            
        }
        
        header("location: /forum/index.php");
    }
    header("location: /forum/index.php");
}

?>