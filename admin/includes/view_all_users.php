<table class="table table-bordered table-hover">
    <thead>
        <th>User Id</th>
        <th>Username</th>
        <th>Password</th>
        <th>First Name</th>
        <th>last Name</th>
        <th>Email</th>
        <th>Image</th>
        <th>Role</th>
        <th>Rand Salt</th>
    </thead>
<tbody>
<?php 
    
    global $connection;
    $query = "SELECT * FROM users";
    $select_users = mysqli_query($connection, $query);

    While ($row = mysqli_fetch_assoc($select_users)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        $rand_salt = $row['rand_salt'];
        
        echo "<tr>";
        echo "<td>{$user_id}</td>";
        echo "<td>{$username}</td>";
        echo "<td>{$user_firstname}</td>";
        echo "<td>{$user_lastname}</td>";
        echo "<td>{$user_email}</td>";
        echo "<td>{$user_image}</td>";
        echo "<td>{$user_status}</td>";
        
        $query = "SELECT * FROM posts WHERE post_id = $user_post_id";
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
