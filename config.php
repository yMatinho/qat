<?php

define("MAIN_DIR", __DIR__.'\\');
define("SITE_URL", "http://localhost/estudo/qat/");

define("DB_DATABASE", "crud_qat");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_HOST", "localhost");

function frameworkAutoloader($class) {
    if(!file_exists('src\\' . $class . '.php'))
        return;
    include 'src\\' . $class . '.php';
}
spl_autoload_register('frameworkAutoloader');