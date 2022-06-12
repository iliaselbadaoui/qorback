<?php

header('Access-Control-Allow-Origin: *');
include_once "../__root__.php";
include_once root."/Classes/Connection.php";
include_once root."/Classes/Listing.php";
include_once root."/Classes/blobImage.php";
include_once root."/Services/listingServices.php";

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    extract($_POST);
    $ls = new listingServices();

    if ($operation == "add_listing")
    {
        if ($ls->addListing($title, $desc, $price, $dateEnd, $user) == TRUE)
        {
            $last = $ls->getLastUserListing($user);
            $listingId =$last['id'];
            if ($last != FALSE)
            {
                extract($_FILES);
                $img1 = new blobImage($pic1['tmp_name']);
                $img2 = new blobImage($pic2['tmp_name']);
                $img3 = new blobImage($pic3['tmp_name']);
                $img4 = new blobImage($pic4['tmp_name']);
//                if ($img1->getType() != 'image/jpeg')
//                    echo "error filetype";
                if ($ls->addListingImages($img1->getBinaryContent(), $img2->getBinaryContent(), $img3->getBinaryContent(), $img4->getBinaryContent(), $listingId) == TRUE)
                    echo "true";
                else
                {
                    echo "error 0 ";
                    $ls->deleteListing(intval($listingId));
                }
            }
            else
            {
                echo "error 1";
                $ls->deleteListing(intval($listingId));
            }
        }
        else
            echo "error 2";
    }
    else if ($operation == 'delete_listing')
    {
        echo json_encode($ls->deleteListing(intval($id)));
    }
}