<form action="" method="post" class="action">
    <div class="form-group">
        <label for="cat-title" class="for">Edit Category</label>
        <?php

// Update query
        
            if(isset($_GET['edit'])){

                $cat_to_edit = $_GET['edit'];

                $query = "SELECT * FROM categories WHERE cat_id = {$cat_to_edit}";
                $select_cat = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_cat)){
                    $cat_id = $row['cat_id'];
                    $cat_name = $row['cat_title'];
                }
                ?>
                <input value=" <?php echo $cat_name; ?>" type="text" class="form-control" name="update_cat_title">
                <?php 
                if(isset($_POST['submit_edit'])){
                    $update_cat_title = $_POST['update_cat_title'];

                    $query = "UPDATE categories ";
                    $query .= "SET cat_title = '{$update_cat_title}' ";
                    $query .= "WHERE cat_id = {$cat_to_edit};";

                    $edit_category_query = mysqli_query($connection, $query);
                    if(!$edit_category_query){
                        die("Query Failed" . mysqli_error($connection));
                    } else {
                        echo "The category successfully updated!";
                    }
                }
            }
        ?>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="submit_edit" value="Update Category">
    </div>
</form>