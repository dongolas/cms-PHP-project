<table class="table table-bordered table-hover">
    <thead>
        <th>Id</th>
        <th>Post Id</th>
        <th>Author</th>
        <th>E-mail</th>
        <th>Content</th>
        <th>Status</th>
        <th>In Response to</th>
        <th>Date</th>
        <th>Approve</th>
        <th>Unapprove</th>
        <th>Delete</th>
    </thead>
<tbody>
<?php 
    
    global $connection;
    $query = "SELECT * FROM comments";
    $select_comments = mysqli_query($connection, $query);

    While ($row = mysqli_fetch_assoc($select_comments)) {
        $comment_id = $row['comment_id'];
        $comment_author = $row['comment_author'];
        $comment_post_id = $row['comment_post_id'];
        $comment_email = $row['comment_email'];
        $comment_status = $row['comment_status'];
        $comment_content = substr($row['comment_content'],0,80) . '...';
        $comment_date = $row['comment_date'];
        
        echo "<tr>";
        echo "<td>{$comment_id}</td>";
        echo "<td>{$comment_post_id}</td>";
        echo "<td>{$comment_author}</td>";
        echo "<td>{$comment_email}</td>";
        echo "<td>{$comment_content}</td>";
        echo "<td>{$comment_status}</td>";
        
        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
        $select_post_id_query = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_post_id_query)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];

            echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</td>";
        }

        echo "<td>{$comment_date}</a></td>";

        echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
        echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
        echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
        echo "</tr>";
    }
    
    ?>
</tbody>
</table>

<?php 
if (isset($_GET['approve'])){
    global $connection;

    $the_comment_id = $_GET['approve'];
    $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = {$the_comment_id}";
    $approve_query = mysqli_query($connection, $query);

    confirmQuery($approve_query);
    header("Location: comments.php");
}

if (isset($_GET['unapprove'])){
    global $connection;

    $the_comment_id = $_GET['unapprove'];
    $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = {$the_comment_id}";
    $unapprove_query = mysqli_query($connection, $query);

    confirmQuery($unapprove_query);
    header("Location: comments.php");
}

if (isset($_GET['delete'])){
    global $connection;

    $the_comment_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
    $delete_query = mysqli_query($connection, $query);

    confirmQuery($delete_query);
    header("Location: comments.php");
}
?>
