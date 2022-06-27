<?php
header('Access-Control-Allow-Origin: *');
include_once "../__root__.php";
include_once root."/Classes/Connection.php";
include_once root."/Classes/user.php";
include_once root."/Classes/blobImage.php";
include_once root."/Services/userServices.php";

	if ($_SERVER["REQUEST_METHOD"] == 'GET')
    {
        extract($_GET);
        $userServices = new userServices();

        if ($operation == "login")
            echo json_encode($userServices->login($email, $password));
        else if ($operation == "user_photo")
            echo json_encode(array('image'=>$userServices->getUserPhoto($id)));
        else if ($operation == "user_numbers")
            echo json_encode($userServices->getUserNumbers($id));
    }
    else if ($_SERVER["REQUEST_METHOD"] == 'POST')
    {
        extract($_POST);
        $userServices = new userServices();

        if ($operation == "create_user")
        {
            if ($userServices->getEmail($email) == false)
                echo json_encode($userServices->createAccount($name, $last, $address, $phone, $email, $password));
            else
                echo "email";
        }
        else if ($operation == "user_photo")
        {
            $blob = new blobImage($_FILES['photo']['tmp_name']);
            if ($userServices->getUserPhoto($id) == "data:;base64,")
                echo json_encode($userServices->addUserPhoto($id, $blob->getType(), $blob->getBinaryContent()));
            else
                echo json_encode($userServices->updateUserPhoto($id, $blob->getType(), $blob->getBinaryContent()));
        }
        else if ($operation == 'update_user')
        {
            echo json_encode($userServices->updateUser($id, $email, $phone));
        }
    }