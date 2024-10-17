<?php
namespace functions;


function dd($value)
{
    echo "<pre>";
   var_dump($value);
    echo"</pre>";
}

function views($basepath)
{
 return BASE_PATH . '/views' . $basepath;
}