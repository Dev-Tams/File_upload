<?php
namespace App\Http\Controllers;

use function functions\views;
use function functions\dd;

class FileUploadController
{
    public function index()
    {
   //     dd($_SERVER);
       return views("file_upload.php");
       
    } 
 
    public function store()
    {
     
    } 
}