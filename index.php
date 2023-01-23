<?php

use Framework\Singleton\Route\Route;

include("config.php");
include("routes.php");
$bruteUrl = str_replace(
    str_replace(["/", "http:", "https:"], "", SITE_URL),
    "",
    str_replace(["/", "http:", "https:"], "", $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"])
);


echo Route::get()->makeActionByUrl($bruteUrl);
