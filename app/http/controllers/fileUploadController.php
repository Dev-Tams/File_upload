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

        $uploadFileDir = __DIR__ . '/../uploads/';
        $randomDir = bin2hex(random_bytes(16));
        $uploadPath = $uploadFileDir . $randomDir . '/';
        
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
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
                    $destPath = $uploadPath . $fileName;

                    if ($fileSize > 50000) {
                        echo "Sorry, your file {$fileName} is too large.<br>";
                        $uploadOk = 0;
                    }

                    if (file_exists($fileName)) {
                        echo "Sorry, file already exists.";
                        $uploadOk = 0;
                    }

                    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf', 'mp3', 'mp4', 'txt', ''];
                    if(! in_array($fileExtension, $allowedExtensions)){
                        $uploadOk = 0;
                        echo "invalid file";
                    }
        

                    $destPath = $uploadPath . $fileName;
                    if ($uploadOk === 1) {
                        if (move_uploaded_file($fileTmpPath, $destPath)) {
                            $this->saveUpload($fileName, $destPath, $fileType, $fileSize);
                            echo "File {$fileName} uploaded successfully!<br>";

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
        global $db;
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
