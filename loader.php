<?php

$base_folder = __DIR__;

$composer = json_decode(file_get_contents("$base_folder/composer.json"), 1);
$namespaces = $composer['autoload']['psr-4'];
$filepaths = $composer['autoload']['files'];

foreach ($filepaths as $filepath) {
    $fullpath = $base_folder.'/'.$filepath;
    if (file_exists($fullpath)) {
        include_once $fullpath;
    }
}

// Foreach namespace specified in the composer, load the given classes
foreach ($namespaces as $namespace => $classpaths) {
    if (!is_array($classpaths)) {
        $classpaths = array($classpaths);
    }
    spl_autoload_register(function ($classname) use ($namespace, $classpaths, $base_folder) {
        // Check if the namespace matches the class we are looking for
        if (preg_match("#^".preg_quote($namespace)."#", $classname)) {
            // Remove the namespace from the file path since it's psr4
            $classname = str_replace($namespace, "", $classname);
            $filename = preg_replace("#\\\\#", "/", $classname).".php";
            foreach ($classpaths as $classpath) {
                $fullpath = $base_folder."/".$classpath."/$filename";
                if (file_exists($fullpath)) {
                    include_once $fullpath;
                }
            }
        }
    });
}
