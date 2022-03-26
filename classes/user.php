<?php
//*  Bar Popko 312365067 - Elizabeth blinov 321966681 

//? the user function we have all the function with get and set,and we will use them in dbClass.php and functions.php

class user
{

    protected $userID;
    protected $password;
    protected $user_name;
    protected $email;
    protected $phoneNumber;
    protected $dateRegistered;
    protected $userIMG;
    protected $user_role;


    public function __construct()
    {
        
    }

    public function getUserID()
    {
        return $this->userID;
    }


    public function setUserID($userID)
    {
        $this->userID = $userID;
    }


    public function getPassword()
    {
        return $this->password;
    }


    public function setPassword($password)
    {
        $this->password = $password;
    }


    public function getUserName()
    {
        return $this->user_name;
    }

    public function setUserName($user_name)
    {
        $this->user_name = $user_name;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }


    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getDateRegistered()
    {
        return $this->dateRegistered;
    }


    public function setDateRegistered($dateRegistered)
    {
        $this->dateRegistered = $dateRegistered;
    }

    public function getUserIMG()
    {
        return $this->userIMG;
    }


    public function setUserIMG($userIMG)
    {
        $this->userIMG = $userIMG;
    }


    public function getuser_role()
    {
        return $this->isAdmin;
    }


    public function setuser_role($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }
}
