<?php
//*  Bar Popko 312365067 - Elizabeth blinov 321966681 
//require_onces give us the option to call this classes , and includes in our other pages and functions.
require_once('classes/user.php');
require_once('classes/dbClass.php');
session_start();
//error array , an array that will catch our errors , and display them if they happened.
$errors = array('user_id' => '', 'password' => '', 'user_name' => '', 'email' => '', 'phone_number' => '', 'registered_on', 'user_photo' => '', 'user_role' => '');
$email = $password = "";
//function to connect to the user
function connectToTheUser()
{
    global $errors;
    //check if user name is empty
    if (empty($_POST['email'])) {
        $errors['email'] = 'יש להזין אימייל ';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'יש להזין אימייל תקין';
        }
    }

    //check if pass is empty
    if (empty($_POST["password"])) {
        if (strlen($_POST["password"]) <= 4) {
            $errors["password"] = "סיסמא חייבת להיות בעלת 4 אותיות או ספרות לפחות";
        }
    }




    $result = false; // if we receive true , we will get the user name.
    $dbHandler = new dbClass(); //the account settings to connect the data base.

    if (isset($_POST['password']) && isset($_POST['email'])) {
        if (strlen($_POST['password']) != 0 && strlen($_POST['email']) != 0) {
            $result = $dbHandler->userLogin($_POST['password'], $_POST['email']);
            if ($result) {
                include('confirmLogin.php'); // if we get true , we will redirect to this page , and apply the rules there.
            } else {
                echo "<p class=\"kuku\">שם משתמש או הסיסמא אינם נכונים , אנא נסה שוב.</p>"; //if the user do not exist we will enter this error into associative array
            }
        }
    }
}

//the function that get us the user name.
function getLoginName()
{
    $result = null; //if we won't receive any value it will be null and we will get "אורח" print.
    $dbHandler = new dbClass();  //the account settings to connect the data base.
    if (isset($_POST['email'])) {
        if (strlen($_POST['email']) != 0)
            $result = $dbHandler->userName($_POST['email']);
        if ($result != null)
            $_SESSION['user_name'] = $result;
        else
            $_SESSION['user_name'] = "אורח";
    } else
        $_SESSION['user_name'] = "אורח";//if we cant sign in properly
}



function register()
{
    global $errors;


    //check user name
    if (empty($_POST["user_name"])) {
        $errors['user_name'] = 'יש להזין שם משתמש';
    } elseif (!preg_match('/^[ \w]+$/', $_POST["user_name"])) {
        $errors["user_name"] = 'invalid username';
    }

    //check email
    if (empty($_POST['email'])) {
        $errors['email'] = 'יש להזמין אימייל';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'האימייל חייב להיות תקין';
        }
    }


    //check phone number
    if (empty($_POST['phone_number'])) {
        $errors['phone_number'] = 'יש להזמין מספר טלפון סלולרי';
    } elseif (!preg_match('^([0|1]\d{1,3}[-])?\d{7,10}$', $_POST['phone_number'])) {
        $errors['phone_number'] = 'מספר הטלפון אינו תקין , אנא בדוק את הדוגמא כאשר השדה ריק';
    }

    //check password
    if (empty($_POST["password"])) {

        if (strlen($_POST["password"]) <= 4) {
            $errors["password"] = "סיסמא חייבת להיות בעלת 4 אותיות או ספרות לפחות";
        }
    } elseif (!preg_match("#[0-9]+#", $_POST["password"])) {
        $errors["password"] = "על הסיסמא להכיל לפחות מספר אחד";
    } elseif (!preg_match("#[A-Z]+#", $_POST["password"])) {
        $errors["password"] = "על הסיסמא להכיל לפחות אות גדולה אחת";
    } elseif (!preg_match("#[a-z]+#", $_POST["password"])) {
        $errors["password"] = "על הסיסמא להכיל לפחות אות קטנה אחת";
    }


    //checking if all the data were sent correctly.
    $dbHandler = new dbClass(); //the account settings to connect the data base.
    if (strlen($_POST['password']) != 0 && strlen($_POST['email']) != 0 &&  strlen($_POST['phone_number']) != 0 && strlen($_POST['user_name']) != 0) {
        if ($dbHandler->isExist($_POST['email']))
            $dbHandler->setNewUser($_POST['password'], $_POST['user_name'], $_POST['email'], $_POST['phone_number']);
        else
            $errors["email"] = "משתמש בעל מייל דומה כבר קיים במערכת"; //error message
    }
}
//get the post and print it outside
function getPost()
{
    $post = new dbClass(); //the account settings to connect the data base.
    $content = $post->getRecentPost();
    foreach ($content as $item) {
        if (isset($_POST[$item->getPostId()]))
            $post->setNotPublished($item->getPostId());
        else
            echo "<p>" . $item->getPostTitle() . " " . $item->getPostAuthor() . "<input type=\"submit\" name=\"" . $item->getPostId() . "\" value=\"deletePost\"></p>";
    }//get the post title , print it inside the "<p>" and then creating a "submit" button
    // that has name has PostId , the value is delete , each time we clicking the submit(delete) button we will call "not published function" 
    //and the post will be changed his status to "nothing" ,  status nothing means it wont be published.
}

//creating a report with all the data regrading post class.
function Save()
{
    $file = fopen("report.txt", "w");//"w" means , if the file do not exist , fopen will create a new file and write the data inside
                                                    //with this filename.
    $text = "";//creating an empty string , that will get our get methods later in the function.
    $post = new dbClass(); //the account settings to connect the data base.
    $content = $post->getRecentPost();
    foreach ($content as $item) { //
        $text .= $item->getPostId() . " " . $item->getPostTitle() . " " . $item->getPostDetail()
         . " " . $item->getPostCategory() . " " . $item->getPostImage() . " " . $item->getPostDate() 
         . " " . $item->getPostStatus() . " " . $item->getPostAuthor() . " " . $item->getPostViews() . " " . PHP_EOL;
         // PHP_EOL represents the endline character for the current system. For instance.
         // it will not find a Windows endline when executed on a unix-like system.
        fwrite($file, $text);//the file perimeter is the file we want to write into,the second parameter is the data we want to insert inside the file .
        $text = "";
    }
    unset($_POST['save']);//creating unset function in order to save the report only one time , after it saves , the procedure is terminated
    
}
