<?php

if(isset($_POST['create_post'])){
    $post_author = $_POST['post_author'];
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_comment_count = 0;
    $post_date = date("j, n, Y");

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content,post_tags, post_comment_count, post_status) ";
    $query .= "VALUES('{$post_category_id}','{$post_title}' ,'{$post_author}' ,now() ,'{$post_image}' ,'{$post_content}' ,'{$post_tags}', '{$post_comment_count}' ,'{$post_status}' )";

    $create_new_post = mysqli_query($connection, $query);
    
    confirmQuery($create_new_post);
}
?>
<form action="" method="post" enctype="multipart/form-data">    
     
     
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>
     
    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>


    <div class="form-group">
        <label for="category">Add Category</label>
        <select name="post_category" id="post_category" class="form-control">
            <?php
            $query = "SELECT * FROM categories";
            $select_cat = mysqli_query($connection, $query);
            confirmQuery($select_cat);

            while($row = mysqli_fetch_assoc($select_cat)){
                $cat_name = $row['cat_title'];
                $cat_id = $row['cat_id'];

                echo "<option value='{$cat_id}'>$cat_name</option>";
            }
            
            ?>

      </select>
    </div>

    <div class="form-group">
        <select name="post_status" id="">
            <option value="draft">Post Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>
    
      

    <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file" name="image">
    </div>

    <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" class="form-control" name="post_tags">
    </div>
      
    <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea class="form-control "name="post_content" id="body" cols="30" rows="10">
         </textarea>
    </div>
      
      

    <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>


</form>