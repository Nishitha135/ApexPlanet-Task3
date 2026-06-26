<?php

$conn = mysqli_connect("localhost", "root", "", "blog_task3");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>