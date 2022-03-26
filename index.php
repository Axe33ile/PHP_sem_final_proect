<?php
require_once('includes/header.php');
require_once('classes/dbClass.php');
?>

<!doctype html>
<html lang="en">
<style>
    p {
        background-color: white;
        margin: 5px;
        height: 200px;
    }
</style>

<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>עמוד ראשי</title>
</head>

<body>
    <form method="POST">
        <input type="submit" value="save" name="save">
        <div class="grid">
            <h1 class="recent-post-label">recent posts:</h1>
            <div></div>
            <div></div>
            <?php
            getPost();
            if (isset($_POST['save']))
                Save();
            ?>
        </div>
    </form>

</body>

</html>