<?php

/**
 * Created by PhpStorm.
 * User: nelly
 * Date: 3/9/2021
 * Time: 2:14 PM
 */
class StorePassport
{
    public function store()
    {

        $filename = time().'-'.$_FILES['passport']['name'];
        $targetDir = "../asset/passports/".$filename;
        $fileType = strtolower(pathinfo($targetDir,PATHINFO_EXTENSION));

        // Allow certain file formats
        $allowTypes = array("jpg","jpeg","png");

        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            $upload = move_uploaded_file($_FILES['passport']['tmp_name'],$targetDir);
            if(!$upload){
                http_response_code(404);
                die(json_encode(array('message' => "Sorry, there was an error uploading your file.")));
            }
        } else {
            http_response_code(404);
            die(json_encode(array('message' => "Sorry, only JPG, JPEG, PNG and GIF files are allowed to upload.")));
        }

        return $filename;
    }

}