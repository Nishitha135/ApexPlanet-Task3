<?php
include 'db.php';

if(isset($_POST['submit']))
{
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $content = mysqli_real_escape_string($conn,$_POST['content']);

    $sql = "INSERT INTO posts(title,content) VALUES('$title','$content')";

    if(mysqli_query($conn,$sql))
    {
        header("Location: dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Post</title>

<link rel="stylesheet" href="style.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

</head>

<body>

<div class="form-container">

<h2>✨ Create New Blog Post</h2>

<form method="POST">

<input type="text"
name="title"
placeholder="Enter Post Title"
required>

<textarea
name="content"
placeholder="Write your content..."
required></textarea>

<button type="submit" name="submit">

Publish Post 🚀

</button>

</form>

<a href="dashboard.php" class="back-btn">

← Back to Dashboard

</a>

</div>

</body>
</html>