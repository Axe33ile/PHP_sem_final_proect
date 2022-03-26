<?php
//*  Bar Popko 312365067 - Elizabeth blinov 321966681 

//? the post function we have all the function with get and set,and we will use them in dbClass.php and functions.php

class post
{

    protected $post_id;
    protected $post_title;
    protected $post_detail;
    protected $post_category;
    protected $post_image;
    protected $post_date;
    protected $post_status;
    protected $post_author;
    protected $post_views;



    public function getPostId()
    {
        return $this->post_id;
    }


    public function setPostId($post_id)
    {
        $this->post_id = $post_id;
    }


    public function getPostTitle()
    {
        return $this->post_title;
    }


    public function setPostTitle($post_title)
    {
        $this->post_title = $post_title;
    }


    public function getPostDetail()
    {
        return $this->post_detail;
    }


    public function setPostDetail($post_detail)
    {
        $this->post_detail = $post_detail;
    }


    public function getPostCategory()
    {
        return $this->post_category;
    }


    public function setPostCategory($post_category)
    {
        $this->post_category = $post_category;
    }


    public function getPostImage()
    {
        return $this->post_image;
    }


    public function setPostImage($post_image)
    {
        $this->post_image = $post_image;
    }


    public function getPostDate()
    {
        return $this->post_date;
    }


    public function setPostDate($post_date)
    {
        $this->post_date = $post_date;
    }

    public function getPostStatus()
    {
        return $this->post_status;
    }


    public function setPostStatus($post_status)
    {
        $this->post_status = $post_status;
    }


    public function getPostAuthor()
    {
        return $this->post_author;
    }


    public function setPostAuthor($post_author)
    {
        $this->post_author = $post_author;
    }


    public function getPostViews()
    {
        return $this->post_views;
    }


    public function setPostViews($post_views)
    {
        $this->post_views = $post_views;
    }


    

}



