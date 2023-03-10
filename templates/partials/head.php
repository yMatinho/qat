<?php

use Framework\Singleton\Asset\Asset;

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{seoTitle}}</title>
    <meta name="description" value="{{ seoDescription }}">
    <link rel="stylesheet" href="<?php echo Asset::get()->path("css/main.css") ?>">
    <link rel="stylesheet" href="<?php echo Asset::get()->path("css/all.min.css") ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>