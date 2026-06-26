<?php
include 'db.php';

$limit = 5; // Posts per page

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$start = ($page - 1) * $limit;

$search = "";

if(isset($_GET['search']) && $_GET['search'] != "")
{
    $search = mysqli_real_escape_string($conn,$_GET['search']);

    $sql = "SELECT * FROM posts
            WHERE title LIKE '%$search%'
            OR content LIKE '%$search%'
            ORDER BY id DESC
            LIMIT $start,$limit";

    $countQuery = "SELECT COUNT(*) AS total
                   FROM posts
                   WHERE title LIKE '%$search%'
                   OR content LIKE '%$search%'";
}
else
{
    $sql = "SELECT * FROM posts
            ORDER BY id DESC
            LIMIT $start,$limit";

    $countQuery = "SELECT COUNT(*) AS total FROM posts";
}

$result = mysqli_query($conn,$sql);

$countResult = mysqli_query($conn,$countQuery);

$totalRows = mysqli_fetch_assoc($countResult)['total'];

$totalPages = ceil($totalRows / $limit);
echo "Total Rows = " . $totalRows . "<br>";
echo "Total Pages = " . $totalPages . "<br>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Management System</title>

    <link rel="stylesheet" href="style.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>

<div class="container">

    <header>

        <h1>Blog Management System</h1>

        <p>Create • Search • Manage • Explore</p>

    </header>

    <div class="dashboard">

    <div class="card">

        <i class="fa-solid fa-file-lines"></i>

     <h2><?php echo $totalRows; ?></h2>

        <p>Total Posts</p>

    </div>

    <div class="card">

        <i class="fa-solid fa-book-open"></i>

        <h2>Blog</h2>

        <p>Management</p>

    </div>

    <div class="card">

        <i class="fa-solid fa-star"></i>

        <h2>Creative</h2>

        <p>Dashboard</p>

    </div>

</div>

<div class="top-bar">

<form action="" method="GET" class="search-box">
<input
type="text"
name="search"
placeholder="🔍 Search Posts..."
value="<?php echo $search; ?>">

<button>

Search

</button>

</form>

<a href="add_post.php" class="add-btn">

<i class="fa-solid fa-plus"></i>

Add Post

</a>

</div>

    <div class="posts">

<?php

if(mysqli_num_rows($result)>0){

while($row=mysqli_fetch_assoc($result))
{

?>

<div class="post-card">

    <h2>
        <i class="fa-solid fa-book-open"></i>
        <?php echo $row['title']; ?>
    </h2>

    <p>

        <?php echo substr($row['content'],0,180); ?>...

    </p>

    <div class="actions">

        <a href="edit_post.php?id=<?php echo $row['id']; ?>" class="edit">

            <i class="fa-solid fa-pen"></i>
            Edit

        </a>

        <a href="delete_post.php?id=<?php echo $row['id']; ?>"
class="delete"
onclick="return confirm('Are you sure you want to delete this post?');">

            <i class="fa-solid fa-trash"></i>
            Delete

        </a>

    </div>

</div>
<?php

}

}else{

echo "<h3 style='color:white;text-align:center;'>No Posts Found</h3>";

}

?>

</div>
<!-- Pagination Starts Here -->

<div class="pagination">

<?php

if($page > 1)
{
    echo "<a href='?page=".($page-1)."&search=$search'>❮ Prev</a>";
}

for($i = 1; $i <= $totalPages; $i++)
{
    $active = ($page == $i) ? "active-page" : "";

    echo "<a class='$active' href='?page=$i&search=$search'>$i</a>";
}

if($page < $totalPages)
{
    echo "<a href='?page=".($page+1)."&search=$search'>Next ❯</a>";
}

?>

</div>

</div>

</body>
</html>
