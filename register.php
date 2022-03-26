<!DOCTYPE html>
<html>

<head>
    <title>הרשמה למערכת</title>
    <link rel="stylesheet" type="text/css" href="css/register.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>

<body>
    <?php
    include('includes/header.php');
    if (isset($_POST['submit'])) {
        //calling to register function if the user enter submit,if the register were ok , the user will be saved,
        //else , there will be an error at the places where the data is false.
        register();
    }
    ?>
    <div class="register_form">
        <h2>הרשמה</h2>

        <form method="POST">
            <input type="text" class="input-group" name="user_name" placeholder="Your name please" title="שם מלא בעברית בבקשה">

            <label for="f-name">* שם מלא</label>
            <div class="error"><?php echo $errors['user_name'] ?></div>
            <p></p>
            <input type="text" class="input-group" name="email" pattern="^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$" placeholder="barpupco@gmail.com" title="Please enter email">
            <label for="email"> * אימייל </label>
            <div class="error"><?php echo $errors['email'] ?></div>
            <p></p>
            <input type="text" class="input-group" name="phone_number" placeholder="exmaple:052-231-1234" title="must enter phone with 10 digits">
            <label for="phone"> * טלפון נייד </label>
            <div class="error"><?php echo $errors['phone_number'] ?></div>
            <p></p>
            <input type="text" class="input-group" title="password" name="password">
            <label> * סיסמא </label>
            <div class="error"><?php echo $errors['password'] ?></div>
            <br><br>
            <button type="submit" class="btn" name="submit">submit</button>


            <p> משתמש קיים ? <a href="login.php">התחבר</a></p>


</body>
</div>
</form>

</html>