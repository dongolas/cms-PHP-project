<?php
    if(isset($_GET['p_id'])){
        $the_post_id = $_GET['p_id'];
    }
    
    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
    $select_post = mysqli_query($connection, $query);

    While ($row = mysqli_fetch_assoc($select_post)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_content = $row['post_content'];
    }

    if (isset($_POST['update_post'])){
        $post_author = $_POST['post_author'];
        $post_title = $_POST['post_title'];
        $post_category = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];

        move_uploaded_file($post_image_temp, "../images/$post_image");

        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
            $select_post = mysqli_query($connection, $query);

            While ($row = mysqli_fetch_assoc($select_post)) {
                $post_image = $row['post_image'];
            }
        }
        
        $query = "UPDATE posts SET 
        post_category_id = '{$post_category}', 
        post_title = '{$post_title}', 
        post_author = '{$post_author}', 
        post_image = '{$post_image}', 
        post_content = '{$post_content}',
        post_tags = '{$post_tags}', 
        post_status = '{$post_status}'
        WHERE post_id = {$the_post_id} ";

        $update_query = mysqli_query($connection, $query);

        confirmQuery($update_query);

    }
    
?>

<form action="" method="post" enctype="multipart/form-data">    
     
     
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
    </div>
     
    <div class="form-group">
        <label for="author">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <label for="category">Category</label>
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
        <label for="status">Status</label>
        <select value="<?php echo $post_status; ?>" name="post_status" id="" class="form-control">
            <option value="draft">Post Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>
    
      

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
        <img width="50" src='../images/<?php echo $post_image; ?>' alt=""/>
    </div>

    <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>
      
    <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea class="form-control "name="post_content" id="body" cols="30" rows="10">
            <?php echo $post_content; ?>
         </textarea>
    </div>
      
      

    <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>


</form>