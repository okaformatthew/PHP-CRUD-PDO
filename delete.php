<?php

require 'classes/Database.php';
$database =  new Database();
if(isset($_GET['id'])){
    $id = $_GET['id'];
   $database->query("DELETE FROM post WHERE id = :id");
   $database->bind(':id', $id);
   if($database->execute()){
       header("Location:index.php");
   }else{
       echo "Something went wrong ";
   }
}

