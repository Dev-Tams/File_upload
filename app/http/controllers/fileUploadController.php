<?php

namespace App\Http\Controllers;

use App\Database;

use function functions\views;
class FileUploadController
{
    public function index()
    {
        return views("file_upload.php");
    }

    public function store()
    {

        $uploadFileDir = './uploads/';
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }
        $uploadOk = 1;



        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $fileFields = ['image', 'audio', 'video', 'document'];


            foreach ($fileFields as $files) {
                if (isset($_FILES[$files])) {
                    $fileTmpPath = $_FILES[$files]['tmp_name'];
                    $fileSize = $_FILES[$files]['size'];
                    $fileName = $_FILES[$files]['name'];
                    $fileType = $_FILES[$files]['type'];
                    $destPath = $uploadFileDir . $fileName;

                    if ($fileSize > 50000) {
                        echo "Sorry, your file {$fileName} is too large.<br>";
                        $uploadOk = 0;
                    }

                    if (file_exists($fileName)) {
                        echo "Sorry, file already exists.";
                        $uploadOk = 0;
                    }

                    $destPath = $uploadFileDir . $fileName;
                    if ($uploadOk === 1) {
                        if (move_uploaded_file($fileTmpPath, $destPath)) {
                            echo "File {$fileName} uploaded successfully!<br>";

                            // Call saveUpload to save file info to the database
                            $this->saveUpload($fileName, $destPath, $fileType, $fileSize);
                        } else if ($_FILES[$files]["error"] > 0) {
                            echo "No file uploaded for {$files}.<br>";
                        }
                    }
                    $uploadOk = 1;
                } else {
                    echo "Faild to upload file {$files}.<br>";
                }
            }
        }
    }

    public function saveUpload($fileName, $filePath, $fileType, $fileSize)
    {
        
        $config = require BASE_PATH .'config/database.php';
        $dbConfig = $config['Database'];
        
           $db = new Database($dbConfig);    

            try {
                $db->query('INSERT into uploads (file_name, file_path, file_type, file_size) VALUES (:file_name, :file_path, :file_type, :file_size)', [
                    'file_name' => $fileName,
                    'file_path' => $filePath,
                    "file_type" => $fileType,
                    "file_size" => $fileSize,
                   ]);
                   echo "File details stored in the database.<br>";
            } catch (\PDOException $e) {
                echo "Failed to save file in database " . $e->getMessage();
            }
          

    }
}
