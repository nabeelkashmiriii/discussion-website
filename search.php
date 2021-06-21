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
        
    ?>
      

    <!-- Search results starts here -->
    <div class="container my-3">
    <h1>Search results for "<i><?php echo $_GET['query'] ?></i>"</h1>

    <?php 
        
        $query=$_GET['query'];
        $sql = "SELECT * FROM `threads` WHERE MATCH (thread_title,thread_desc) against ('$query')";
            $result = mysqli_query($conn, $sql);
            $rowcount = mysqli_num_rows($result);
            
            while ($row = mysqli_fetch_assoc($result))
            
            {
                $thread_title = $row['thread_title'];
                $thread_desc = $row['thread_desc'];
                $thread_id = $row['thread_id'];
                $url = "threads.php?threadid=".$thread_id;
                // display search results
                echo '<div class="result">
                <h3><a href="'. $url .'" class="text-dark">'. $thread_title .'</a></h3>
                <p>'. $thread_desc .'</p>
                
                </div>';
            
            
            }
            if ($rowcount == 0)
            {
                echo "<h6>did not match any documents.</h6>
                <p>Suggestions:
                <ul>
                <li>Make sure that all words are spelled correctly.</li>
                <li>Try different keywords.</li>
                <li>Try more general keywords.</li>
                </ul></p>
                ";
            }
        
        
        ?> 
        
    
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