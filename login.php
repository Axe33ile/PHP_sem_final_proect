<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>התחברות לאתר</title>
</head>

<style>
    .kuku {
        text-align: center;
        color: blue;
    }
</style>

<body>

    <?php
    include('includes/header.php');
    /// include('includes/functions.php');
    if (isset($_POST['submit'])) {
        connectToTheUser();
        getLoginName();
    }

    ?>

    <div class="login">
        <form method="POST">
            <label for=" email">:אימייל</label>
            <p></p>
            <input type="email" name="email" minlength="0">
            <div><?php echo $errors['email'] ?> </div>
            <p></p>
            <label for="password">:סיסמא</label>
            <p></p>
            <input type="password" name="password" minlength="0" maxlength="20">
            <div><?php echo $errors['password'] ?> </div>
            <p></p>
            <input type="submit" name="submit" value="התחבר" class="login">
            <p></p>
            <label for="help">?עוד לא משתמש</label>
            <p></p>
            <a href="register.php">הרשם</a>
        </form>


    </div>


</body>

</html>