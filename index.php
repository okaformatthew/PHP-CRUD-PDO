
        <?php
        
        require 'includes/header.php';
        require 'classes/Database.php';
        $database = new Database();
         $database->query("SELECT * FROM post");
         $rows = $database->resultSet();
         ?>
       
        <div class="container">
            <div class="mt-5">
                <button data-toggle="collapse" data-target="#demo" class="btn btn-outline-secondary">Add Item</button>
             <div id="demo" class="collapse">
                 <a href="addpost.php" class="btn btn-success">Add Post Here</a>
             </div>
          </div> 
           <h1 class="text-center">Posts</h1>
        <?php foreach($rows as $row):?>
           <div class="jumbotron">
            <h2><?php echo $row['title']; ?></h2>
            <p>Published date: <small><?php echo $row['create_date']; ?></small></p>
         <p><?php echo $row['content']; ?></p>
         <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-info">Update</a>
         <a href="delete.php?id=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
           </div>
        <?php endforeach; ?>
        
        </div>
  <?php require 'includes/footer.php'; ?>
