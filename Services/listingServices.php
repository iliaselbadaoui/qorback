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
        foreach ($rawData as $reg)
        {
            for ($i=0; $i<count($reg); $i++)
            {
                $reg['pic'.strval($i)] = "data:".$reg['pic'.strval($i).'type'].";base64,".base64_encode(stripslashes($reg['pic'.strval($i)]));
            }
        }
        return $rawData;
    }

}