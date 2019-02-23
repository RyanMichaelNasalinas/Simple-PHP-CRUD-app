<?php
    require ('config/config.php');
    require ('config/db.php');

    //Create a query
    $query = "SELECT * FROM posts ORDER BY created_date DESC";

    //Get Result
    $result = mysqli_query($conn, $query);

    //Fetch all data
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    ///Free Connection
    mysqli_free_result($result);

    //Close connection
    mysqli_close($conn);
?>
<?php require ('req/header.php'); ?>
<div class="container">
       <h1>Posts</h1>
        <?php foreach($posts as $post):?>
        <div class="card bg-light m-3">
            <div class="card-body ">
            <h3><?php echo $post['title']; ?></h3>
            <small>Created on <?php echo $post['created_date']; ?> By:
            <?php echo $post['author']; ?>
            </small>
            <p><?php echo $post['body'];?></p>
            <a class="btn btn-primary" href="<?php echo ROOT_URL;?>post.php?id=<?php echo $post['id']; ?>">Read More</a>

        </div>
    </div>
        <?php endforeach;?>
</div>
<?php require ('req/footer.php'); ?>


