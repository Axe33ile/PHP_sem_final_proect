<?php
declare (strict_types=1);//The declare construct is used to set execution directives for a block of code.(https://www.php.net/manual/en/control-structures.declare.php)
require_once('classes/dbClass.php');
require_once('includes/functions.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="./css/style.css">

</head>
<style>
    .login-name {
        text-align: right;
    }
</style>

<body>
    <div class="container">
        <!-- main grid -->
        <div class="menu">

            <a href="register.php">הרשם</a>
            <a href="login.php">התחבר</a>
            <a href="index.php">דף ראשי</a>


        </div>
        <h1 class="login-name"> שלום
            <?php
            echo $_SESSION['user_name'];
            ?> </h1>

    </div>
</body>

<?php
