<?php
if(!empty($_GET['file'])){
    $storefrontimagefilename  = basename($_GET['file']);
    // $filePath  = "files/".$fileName;
    // $storefrontimagefilename = $_FILES["storefrontimage"]["name"];
    // $storefrontimagetempname = $_FILES["storefrontimage"]["tmp_name"];
    $storefrontimagefolder = "./image/" . $storefrontimagefilename;
    
    if(!empty($storefrontimagefilename) && file_exists($storefrontimagefolder)){
        //define header
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$storefrontimagefilename");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
        
        //read file 
        readfile($storefrontimagefolder);
        exit;
    }
    else{
        echo "file not exist";
    }


}