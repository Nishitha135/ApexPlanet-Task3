<?php
include 'db.php';

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM posts WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $content = mysqli_real_escape_string($conn,$_POST['content']);

    mysqli_query($conn,"UPDATE posts SET title='$title', content='$content' WHERE id=$id");

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Post</title>

<link rel="stylesheet" href="style.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

</head>

<body>

<div class="form-container">

<h2>✏️ Edit Blog Post</h2>

<form method="POST">

<input
type="text"
name="title"
value="<?php echo $row['title']; ?>"
required>

<textarea
name="content"
required><?php echo $row['content']; ?></textarea>

<button type="submit" name="update">

Update Post

</button>

</form>

<a href="dashboard.php" class="back-btn">

← Back to Dashboard

</a>

</div>

</body>
</html>