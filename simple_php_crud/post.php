<?php
    require ('config/config.php');
    require ('config/db.php');

    if(isset($_POST['delete'])){
        $delete_id = mysqli_real_escape_string($conn,$_POST['delete_id']);
       

        $query = "DELETE FROM posts WHERE id= {$delete_id}";

       
        if(mysqli_query($conn, $query)){
            header('Location: '. ROOT_URL .'');
        } else {
            echo "ERROR: ". mysqli_error($conn);
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
    <br>
        <a href="<?php echo ROOT_URL; ?>" class="btn btn-dark">Back</a>
        <h1><?php echo $post['title']; ?></h1>
            <small>Created on <?php echo $post['created_date']; ?> By:
            <?php echo $post['author']; ?>
            </small>
            <p><?php echo $post['body'];?></p>      
            <hr>
            <form class="float-right" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="hidden" name="delete_id" value="<?php echo $post['id'];?>">
                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>
            <a href="<?php echo ROOT_URL?>editpost.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">Edit Post</a> 
</div>

<?php require ('req/footer.php'); ?>
