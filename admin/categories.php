<?php include("includes/admin_header.php"); ?>

    <div id="wrapper">

        <?php include("includes/admin_navigation.php") ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Administration
                            <small>Author</small>
                        </h1>
                        <div class="col-sm-6">
                            <?php 
                            insertCategories();
                            ?>
                            <form action="" method="post" class="action">
                                <div class="form-group">
                                    <label for="cat-title" class="for">Add Category</label>
                                    <input type="text" class="form-control" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                                </div>
                            </form>
                            
                            <?php
                            if (isset($_GET['edit'])){
                                $cat_id = $_GET['edit'];
                                include "includes/update_categories.php";
                            }
                            ?>
                            

                        </div>
                        
                        <!-- Add Category Form -->

                        <div class="col-sm-6">

                            <table class="table table-bordered table-hover">
                                <thread>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th>Delete</th>
                                    </tr>
                                </thread>
                                <tbody>
                                <?php 
            //Find all categories query
                                findAllCategories();
                                ?>
                                <?php
            //Delete query
                                deleteCategory();
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include("includes/admin_footer.php") ?>
