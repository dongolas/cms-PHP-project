<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

    <!-- Navigation -->
<?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                <!-- Blog Posts -->
                <?php
                    $query = "SELECT * FROM posts";
                    $select_all_posts_query = mysqli_query($connection, $query);
                    
                    While ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_content = substr($row['post_content'],0,280);
                        $post_image = $row['post_image'];
                        $post_status = $row['post_status'];

                        if($post_status == 'published'){
                                
                        echo "<li class='list-group-item'>
                                <h2>
                                    <a href='post.php?p_id={$post_id}'>{$post_title}</a>
                                </h2>
                                <p class='lead'>
                                by <a href='index.php'>{$post_author}</a>
                                </p>
                                <p><span class='glyphicon glyphicon-time'></span> Posted on {$post_date} PM</p>
                                <hr>
                                <img class='img-responsive' src='images/{$post_image}' alt='#'>
                                <hr>
                                <p>{$post_content}</p>
                                <a class='btn btn-primary' href='post.php?p_id={$post_id}'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>
                
                                <hr>
                            </li>";
                                }
                    }
                ?>
                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php" ?>
        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/footer.php" ?>