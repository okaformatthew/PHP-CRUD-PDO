<?php
require 'classes/Database.php';
require 'includes/header.php';
  $database = new Database();
        
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if(isset($post['submit'])){
           $title = $post['title'];
           $author = $post['author'];
           $content = $post['content'];
           
           $database->query("INSERT INTO post (title, author, content, create_date) VALUES(:title, :author, :content, :create_date)");
           $database->bind(':title', $post['title']);
           $database->bind(':author', $post['author']);
           $database->bind(':content', $post['content']);
           $database->bind(':create_date', $post['date-time']);
           $database->execute();
           if($database->lastInsertId()){
               header("Location:index.php");
           }
        }
?>
        <div class="container mb-3">
        <h1 class="text-primary text-center text-uppercase">Add Post</h1>
        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label>Post Title</label>
                <input type="text" name="title" placeholder="Add Post Title" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" placeholder="Post Author" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Content</label>
                <textarea name="content" cols="" rows="" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Date & Time</label>
                <input type="datetime" name="date-time" class="form-control"/>
            </div>
            <input type="submit" name="submit" value="Save Post" class="btn btn-primary">
            <a href="index.php" class="btn btn-outline-info">Back To HomePage</a>
        </form>
        </div>
       

<?php require 'includes/footer.php'; ?>