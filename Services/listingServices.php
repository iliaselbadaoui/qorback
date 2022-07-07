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
            array_push($newData, array('listingID'=>$reg['id'],'userID'=>$reg['userID'],'userFullName'=>$reg['name'].' '.$reg['last'],'userPhoto'=>$userpic,'title'=>$reg['title'],'desc'=>$reg['description'],
                'price'=>$reg['targetPrice'], 'collected'=>$reg['collectedFunds'], 'expires'=>$reg['dateEnd'],
                'pic1'=>$reg['pic1'], 'pic2'=>$reg['pic2'], 'pic3'=>$reg['pic3'], 'pic4'=>$reg['pic4']));
        }
        return $newData;
    }

    public function getUserTickets($id)
    {
        $prepared = $this->connect->prepare("CALL get_user_participations(?)");
        $prepared->execute($id);
        $rawData = $prepared->fetchAll(PDO::FETCH_ASSOC);
        $newData = array();
        echo count($rawData);
        foreach ($rawData as $reg)
        {
            $reg['pic1'] = "data:".$reg['pic1type'].";base64,".base64_encode(stripslashes($reg['pic1']));
            $reg['pic2'] = "data:".$reg['pic2type'].";base64,".base64_encode(stripslashes($reg['pic2']));
            $reg['pic3'] = "data:".$reg['pic3type'].";base64,".base64_encode(stripslashes($reg['pic3']));
            $reg['pic4'] = "data:".$reg['pic4type'].";base64,".base64_encode(stripslashes($reg['pic4']));
            $userpic = "data:".$reg['mimetype'].";base64,".base64_encode(stripslashes($reg['photo']));
            array_push($newData, array('listingID'=>$reg['id'],'userID'=>$reg['userID'],'tickets'=>$reg['ticks'],'userFullName'=>$reg['name'].' '.$reg['last'],'userPhoto'=>$userpic,'title'=>$reg['title'],'desc'=>$reg['description'],
                'price'=>$reg['targetPrice'], 'collected'=>$reg['collectedFunds'], 'expires'=>$reg['dateEnd'],
                'pic1'=>$reg['pic1'], 'pic2'=>$reg['pic2'], 'pic3'=>$reg['pic3'], 'pic4'=>$reg['pic4']));
        }
        return $newData;
    }

    public function getUserListings($id)
    {
        $prepared = $this->connect->prepare("CALL get_user_listings(?)");
        $prepared->execute(array($id));
        $rows = $prepared->fetchAll(PDO::FETCH_ASSOC);
        $newData = array();
        foreach ($rows as $row)
        {
            $miniature = "data:".$row['type'].";base64,".base64_encode(stripslashes($row['miniature']));
            array_push($newData, array("id"=> $row["id"], "title"=>$row['title'], "miniature"=>$miniature));
        }
        return $newData;
    }

    public function createTicket($user, $listing)
    {
        $prepared = $this->connect->prepare("CALL create_ticket(?, ?)");
        return $prepared->execute(array($user, $listing));
    }

}