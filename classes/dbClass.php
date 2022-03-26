<?php

declare(strict_types=1); //The declare construct is used to set execution directives for a block of code.(https://www.php.net/manual/en/control-structures.declare.php)
require_once('classes/user.php');
require_once('classes/post.php');
class dbClass
{
    //static is used do decrease ram in old pc.
    //we will use private , because we will use them in the program.

    private $host;
    private $db;
    private $charset;
    private $user;
    private $pass;
    private $opt = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    private $connection;
    //information regarding the database , default user is root , database name is - "final_site" , no password.
    public function __construct(
        string $host = "localhost",
        string $db = "final_site",
        string $charset = "utf8",
        string $user = "root",
        string $pass = ""
    ) {
        $this->host = $host;
        $this->db = $db;
        $this->charset = $charset;
        $this->user = $user;
        $this->pass = $pass;
    }
    //connection the data base , in every function we will start with the connection to the database.
    public function connect()
    {
        $dns = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $this->connection = new PDO($dns, $this->user, $this->pass, $this->opt);
    }
    //SHORTCUT Meaning//
    //opt = optional.
    //dns = data source name

    //when we close the function we will disconnect to stop the function from working after getting our relevant information.
    public function disconnect()
    {
        $this->connection = null;
    }


    //this function will get specific user name by his ID.
    //! THIS FUNCTION IS NOT USED IN THE PROJECT !!!
    public function getUsers(int $id): string
    {
        $this->connect();
        $statement = $this->connection->prepare("SELECT * FROM `user` WHERE userID = :id");
        $statement->execute([':id' => $id]);
        $result = $statement->fetchObject('user');
        $this->disconnect();
        return $result->getUserName();
    }

    //function that will get the post if the status of the post is "published".
    public function getRecentPost()
    {
        $this->connect();
        $statement = $this->connection->prepare("SELECT * FROM post WHERE post_status =:status");
        $statement->execute([
            ':status' => 'Published'
        ]);
        $select = [];
        while ($post = $statement->fetchObject('post')) {
            $select[] = $post;
        }
        $this->disconnect();
        return $select;
    }

    //this function will create a new user , after getting the credentials from the form.
    public function setNewUser(string $password, string $username, string $email, string $phone)
    {
        date_default_timezone_set("Asia/Jerusalem"); //israel time stamp.
        // $password = password_hash($password, PASSWORD_DEFAULT); if we want we can encrypt our password hash (page 78 in the php pdf).
        $now = date('Y-m-d H:i:s'); //the time will be saved by this format.
        $this->connect();
        //DEFAULT means the data inside the database is has its one value , like user ID that have auto Increment.
        $statement = $this->connection->prepare("INSERT INTO user VALUES(DEFAULT,:password,:user_name, :email, :phone_number, :dateNow, 'No photo', DEFAULT)");
        $statement->execute([':password' => $password, ':user_name' => $username, ':email' => $email, ':phone_number' => $phone, 'dateNow' => $now]);
        $this->disconnect();
    }


    //isExist function will check if the user already exist in the database.
    public function isExist(string $email)
    {
        $this->connect();
        $statement = $this->connection->prepare("SELECT * FROM user WHERE email = :email");
        $statement->execute([':email' => $email]);
        $result = $statement->fetchObject('user');
        $this->disconnect();
        if ($result == NULL)
            return true;
        return false;
    }

    //the userLogin function will check if the data inside the database is correct or not,the function is similar to isExist.
    public function userLogin(string $password, string $email)
    {
        $this->connect();
        $statement = $this->connection->prepare("SELECT * FROM user WHERE email = :email");
        $statement->execute([':email' => $email]);
        $result = $statement->fetchObject('user');
        $this->disconnect();
        if ($result != null)
            if ($result->getPassword() == $password)
                return true;
        return false;
    }

    //userName function will get the userName after checking his email first,and then returning the name of the email account.
    public function userName(string $email)
    {
        $this->connect();
        $statement = $this->connection->prepare("SELECT * FROM user WHERE email = :email");
        $statement->execute([':email' => $email]);
        $result = $statement->fetchObject('user');
        $this->disconnect();
        if ($result != null)
            return $result->getUserName();
        return null;
    }

    //setting a post in nonPublished value,this function will help us by "deleting/hiding the Post"
    public function setNotPublished(int $id)
    {
        $this->connect();
        $this->connection->exec("UPDATE post SET post_status = 'nothing' where post_id = $id");
        $this->disconnect();
    }
    //set "nothing/unpublished" to published,and then we able to see the post once again.
    public function setPublished(int $id)
    {
        $this->connect();
        $this->connection->exec("UPDATE post SET post_status = 'Published' where post_id = $id");
        $this->disconnect();
    }
}
