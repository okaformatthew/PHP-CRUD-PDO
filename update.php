<?php
require 'includes/header.php';
require 'classes/Database.php';

   $database = new Database();
   if(isset($_GET['id'])){
    $id = $_GET['id'];
   $database->query("SELECT * FROM post WHERE id = :id");
   $database->bind(':id', $id);
   $database->execute();
  $row = $database->single();

   }
   $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
   if(isset($post['submit'])){
       $id = $post['id'];
       $title = $post['title'];
       $author = $post['author'];
       $content = $post['content'];
       
      
       $database->query("UPDATE post SET title = :title, author = :author, content = :content WHERE id = :id");
       $database->bind(':id', $id);
       $database->bind(':title', $title);
       $database->bind(':author', $author);
       $database->bind(':content', $content);
    
       $database->execute();
       
           header("Location:index.php");

     
   }
?>

        <div class="container mb-3">
        <h1 class="text-primary text-center text-uppercase">Update Post</h1>
   
        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
            <input type="text" name="id" value="<?php echo $row['id']; ?> " class="form-control mb-3" hidden/>
            <div class="form-group">
             
                <label>Post Title</label>
                <input type="text" name="title" placeholder="Add Post Title" class="form-control" value="<?php echo $row['title']; ?>"/>
            </div>
            <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" placeholder="Post Author" class="form-control" value="<?php echo $row['author']; ?>"/>
            </div>
            <div class="form-group">
                <label>Content</label>
                <textarea name="content" cols="" rows="" class="form-control"><?php echo $row['content']; ?></textarea>
            </div>
   
            <input type="submit" name="submit" value="Update Post" class="btn btn-primary">
            <a href="index.php" class="btn btn-outline-warning">cancel</a>
        </form>
        
        </div>
       
<?php require 'includes/footer.php'; ?>