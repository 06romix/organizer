<?php
set_include_path($_SERVER['DOCUMENT_ROOT'] . 'dev1' . FD);
function autoload($className)
{
    $fileName = $className . '.php';
    if (file_exists($fileName)) {
        require_once $fileName;
    } else {
        require_once str_replace(CD, FD, $fileName);
    }

}
spl_autoload_register('autoload');