<?php
    require ('config/config.php');
    require ('config/db.php');

    $msg = '';
    $msgClass = '';  

    if(isset($_POST['submit'])){
        $title = mysqli_real_escape_string($conn,htmlspecialchars($_POST['title']));
        $author = mysqli_real_escape_string($conn,htmlspecialchars($_POST['author']));
        $body = mysqli_real_escape_string($conn,htmlspecialchars($_POST['body']));

        if(!empty($title) && !empty($author) && !empty($body)){
        
            $query = "INSERT into posts ";
            $query .= "(title,author,body) VALUES ";
            $query .= "('$title','$author','$body')";
    
            if(mysqli_query($conn, $query)){
                header('Location: '. ROOT_URL .'');
            } else {
                echo "ERROR: ". mysqli_error($conn);
            }
        } else { 
            $msg = 'Please fill up all fields';
            $msgClass = 'alert-danger';  
           
        }


       
    }
    
?>
<?php require ('req/header.php'); ?>
<div class="container">
<br>
        <?php if($msg != ''):?>
            <div class="alert <?php echo $msgClass;?>"><?php echo $msg; ?></div>
        <?php endif;?>
       <h1>Add Posts</h1>
       <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo isset($_POST['title']) ? $title : ''; ?>">
            </div>
            <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" class="form-control" value="<?php echo isset($_POST['author']) ? $author : ''; ?>">
            </div>
            <div class="form-group">
                <label>Body</label>
                <textarea name="body" class="form-control"><?php echo isset($_POST['body']) ? $body : ''; ?></textarea>
            </div>
            <input type="submit" name="submit" value="Submit" class="btn btn-secondary">
            
       </form>
</div>
<?php require ('req/footer.php'); ?>


