<?php
namespace functions;


function dd($value)
{
    echo "<pre>";
   var_dump($value);
    echo"</pre>";
}

function views($path, $attributes = []){
    extract($attributes);

    require BASE_PATH .'views/' . $path;
}

function validated()
{
    
}