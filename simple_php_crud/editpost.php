<?php
    require ('config/config.php');
    require ('config/db.php');

    $msg = '';
    $msgClass = '';

    if(isset($_POST['submit'])){
        $update_id = mysqli_real_escape_string($conn,$_POST['update_id']);
        $title = mysqli_real_escape_string($conn,$_POST['title']);
        $author = mysqli_real_escape_string($conn,$_POST['author']);
        $body = mysqli_real_escape_string($conn,$_POST['body']);

        if(!empty($title) && !empty($author) && !empty($body)){    
            $query = "UPDATE posts SET title='$title',author='$author',body='$body' WHERE id = {$update_id}";

        
            if(mysqli_query($conn, $query)){
                header('Location: '. ROOT_URL .'');
            } else {
                echo "ERROR: ". mysqli_error($conn);
            }
        } else {
            $msg = 'Please dont leave any fields empty';
            $msgClass = 'alert-danger';
        }

    }

    
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    //Create a query
    $query = "SELECT * FROM posts WHERE id = $id";

    //Get Result
    $result = mysqli_query($conn, $query);

    //Fetch all data
    $post = mysqli_fetch_assoc($result);

    ///Free Connection
    mysqli_free_result($result);

    //Close connection
    mysqli_close($conn);
    
?>
<?php require ('req/header.php'); ?>
<div class="container">
    <?php if($msg != ''):?>
        <div class="alert <?php echo $msgClass;?>"><?php echo $msg; ?></div>
    <?php endif;?>
       <h1>Add Posts</h1>
       <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo isset($post['title']) ?  $post['title'] : ''; ?>">
            </div>
            <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" class="form-control"  value="<?php echo isset($post['author']) ? $post['author'] : ''; ?>">
            </div>
            <div class="form-group">
                <label>Body</label>
                <textarea name="body" class="form-control"><?php echo isset($post['body']) ? $post['body'] : ''; ?></textarea>
            </div>
            <input type="hidden" name="update_id" value="<?php echo $post['id']; ?>">
            <input type="submit" name="submit" value="Submit" class="btn btn-secondary">
            
       </form>
</div>
<?php require ('req/footer.php'); ?>


