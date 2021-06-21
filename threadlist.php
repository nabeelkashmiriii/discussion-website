<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Forum|QDiscuss</title>
</head>

<body>
    <!-- include files -->
    <?php 
        include 'partials/_dbconnect.php';
        include 'partials/_header.php';
        
        $id=$_GET['id'];
        $sql = "SELECT * FROM `categories` WHERE category_id=$id";
            $result = mysqli_query($conn, $sql);
            
            while ($row = mysqli_fetch_assoc($result))

            {
                $tittle = $row['category_tittle'];
                $desc = $row['category_description'];
            }
    ?>
    <?php
    $showAlert=FALSE;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST')
    {
        // insert form data in DB
        $form_title = $_POST['title'];
        $form_desc = $_POST['desc'];
        $sql = "INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`) VALUES ('$form_title', '$form_desc', '$id', '0');";
        $result = mysqli_query($conn, $sql);
        $showAlert = TRUE;
        if ($showAlert)
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your Question has been post successfully ,Please wait for other community to response.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }


    }
    
    
    ?>
    <!-- Thread container starts here -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcom To <?php echo $tittle; ?> Discussion</h1>
            <p class="lead"> <?php echo $desc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not
                post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Remain respectful of other members at all times.</p>

        </div>
    </div>
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
    {
        echo'<div class="container">
        <h1 class="my-2">Start a discussion</h1>
        <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label" id="title">Problem Title</label>
                <input type="text" class="form-control" name="title" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Keep your Title Short</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Elaborate Your Concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>';
    }
    else
    {
        echo' <h1 class="my-2">Start a discussion</h1>
        <p>Please LogIn to start a discussion...';
    }
    
    ?>
    <div class="cotainer">
        <h1>Browse Questions</h1>

        <?php 
        
        $id=$_GET['id'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
            $result = mysqli_query($conn, $sql);
            $noresult = true;
            while ($row = mysqli_fetch_assoc($result))
            {
                $noresult = false;
                $thread_id = $row['thread_id'];
                $thread_title = $row['thread_title'];
                $thread_desc = $row['thread_desc'];
                $thread_user_id = $row['thread_user_id'];
                

                echo ' <div class="media my-3">
                <img src="images/userdefault.jpg" width=44px class="mr-0" alt="...">
                <div class="media-body">
                    <h5 class="mt-0"><a href="threads.php?threadid='.$thread_id.'" class="text-decoration-none text-reset">'.$thread_title.':    </a></h5>
                    
                </div>
                <p>'.$thread_desc.'</p>
            </div>';
            
            
            }
            if ($noresult)
            {
                echo '<div class="alert alert-info" role="alert">
                No Results Found!
              </div>';
            }
        
        
        ?>



    </div>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>