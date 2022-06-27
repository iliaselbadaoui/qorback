<?php

include_once "../__root__.php";
include_once root."/Classes/Connection.php";
include_once root."/Classes/user.php";

class userServices
{
	private $connect;

    public function __construct()
	{
	    $this->connect = new Connection();
        $this->connect = $this->connect->getConnection();
	}


    public function getUsers()
	{
        $c  = $this->connect;
        $c = $c->query("CALL read_user()");
        return $c->fetchAll(PDO::FETCH_ASSOC);
	}

    public function login($email, $password)
    {
        $query = $this->connect->query("CALL login('".$email."','".$password."')");
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getUserPhoto($id)
    {
        $query = $this->connect->query("SELECT  photo, mimetype FROM photos WHERE user = $id");
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $image = "data:".$result['mimetype'].";base64,".base64_encode(stripslashes($result['photo']));
        return $image;
    }
    public function createAccount($name, $last, $address, $phone, $email, $password)
    {
        $prepared = $this->connect->prepare("CALL create_user(?,?,?,?,?,?)");
        return $prepared->execute(array($name, $last, $address, $phone, $email, $password));
    }

    public  function  getEmail($email)
    {
        $prepared = $this->connect->prepare("CALL get_email(?)");
        $prepared->execute(array($email));
        return $prepared->fetch(PDO::FETCH_ASSOC);
    }

    public function addUserPhoto($id, $mime, $photo)
    {
        $prepared = $this->connect->prepare("CALL add_user_photo(:id, :photo, :mime)");
        $prepared->bindParam(':id', $id, PDO::PARAM_INT);
        $prepared->bindParam(':photo', $photo, PDO::PARAM_LOB);
        $prepared->bindParam(':mime', $mime, PDO::PARAM_STR, 100);
        return $prepared->execute();
    }
    public function updateUser($id, $email, $phone)
    {
        $prepared = $this->connect->prepare("CALL update_user(?, ?, ?)");
        return $prepared->execute(array($id, $email, $phone));
    }
    public function updateUserPhoto($id, $mime, $photo)
    {
        $prepared = $this->connect->prepare("CALL update_user_photo(:id, :photo, :mime)");
        $prepared->bindParam(':id', $id, PDO::PARAM_INT);
        $prepared->bindParam(':photo', $photo, PDO::PARAM_LOB);
        $prepared->bindParam(':mime', $mime, PDO::PARAM_STR, 100);
        return $prepared->execute();
    }

    public function getUserNumbers($id)
    {
        $prepared = $this->connect->prepare("CALL get_user_numbers(?)");
        $prepared->execute(array($id));
        return $prepared->fetch(PDO::FETCH_ASSOC);
    }
}