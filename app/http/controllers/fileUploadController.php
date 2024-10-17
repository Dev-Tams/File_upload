<?php 
namespace FileUploadController;
use functions;

use function functions\dd;
use function functions\views;

class FileUploadController
{
    public function index()
    {

        dd(123);
        return views("fileupload.htm");
    } 
 
    public function store()
    {
     
    } 
}