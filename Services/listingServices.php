<?php

include_once "../__root__.php";
include_once root."/Classes/Connection.php";
include_once root."/Classes/Listing.php";

class listingServices
{
    private $connect;

    public function __construct()
    {
        $this->connect = new Connection();
        $this->connect = $this->connect->getConnection();
    }

    public function  addListing($title, $desc, $price, $dateEnd, $user)
    {
        $prepared = $this->connect->prepare("CALL create_listing(?, ?, ?, ?, ?)");
        return $prepared->execute(array($title, $desc, $price, $dateEnd, $user));
    }

    public function deleteListing($id)
    {
        $prepared = $this->connect->prepare("CALL delete_listing(?)");
        return $prepared->execute(array($id));
    }

    public function getLastUserListing($user)
    {
        $prepared = $this->connect->prepare("CALL get_last_user_listing(?)");
        $prepared->execute(array($user));
        return $prepared->fetch(PDO::FETCH_ASSOC);
    }

    public function addListingImages($image1, $image2, $image3, $image4, $type1, $type2, $type3, $type4, $listing)
    {
        $prepared = $this->connect->prepare("CALL add_listing_images(?, ?, ?, ?, ?, ?, ?, ?, ?)");
        return $prepared->execute(array($image1, $image2, $image3, $image4, $type1, $type2, $type3, $type4, $listing));
    }

    public function getAllListings()
    {
        $prepared = $this->connect->query("CALL get_all_listings()");
        $rawData = $prepared->fetchAll(PDO::FETCH_ASSOC);
        $newData = array();
        foreach ($rawData as $reg)
        {
            $reg['pic1'] = "data:".$reg['pic1type'].";base64,".base64_encode(stripslashes($reg['pic1']));
            $reg['pic2'] = "data:".$reg['pic2type'].";base64,".base64_encode(stripslashes($reg['pic2']));
            $reg['pic3'] = "data:".$reg['pic3type'].";base64,".base64_encode(stripslashes($reg['pic3']));
            $reg['pic4'] = "data:".$reg['pic4type'].";base64,".base64_encode(stripslashes($reg['pic4']));
            $userpic = "data:".$reg['mimetype'].";base64,".base64_encode(stripslashes($reg['photo']));
            array_push($newData, array('userID'=>$reg['userID'],'userFullName'=>$reg['name'].' '.$reg['last'],'userPhoto'=>$userpic,'title'=>$reg['name'],'desc'=>$reg['description'],
                'price'=>$reg['targetPrice'], 'collected'=>$reg['collectedFunds'], 'expires'=>$reg['dateEnd'],
                'pic1'=>$reg['pic1'], 'pic2'=>$reg['pic2'], 'pic3'=>$reg['pic3'], 'pic4'=>$reg['pic4']));
        }
        return $newData;
    }

}