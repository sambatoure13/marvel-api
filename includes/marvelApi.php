<?php

    $publicKey = "fe38140b5cff04ecbe74f41e68978b4b";
    $privateKey = "ba1e16f8e11673407551d25c30b2b84eb97471a6";
    $ts = time();
    $hash = md5($ts . $privateKey . $publicKey);

    function apiCall($url)
    {
        $fileName = md5($url);
        $filePath = './cache/' . $fileName;
        $fileExist = file_exists($filePath);

        if($fileExist)
        {
            $fileTime = filemtime($filePath);
            $time = time();

            if($fileTime < $time - 60 * 60 * 24 * 7)
            {
                unlink($filePath);
                $fileExist = false;
            }
        }
        
        if($fileExist)
        {

            $result = file_get_contents($filePath);
        }
        else
        {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

            $result =curl_exec($curl);

            file_put_contents($filePath, $result);
        }
        $jsonResult = json_decode($result);

        return $jsonResult;
    }