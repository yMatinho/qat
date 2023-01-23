<?php

use Framework\Singleton\Route\Route;
?>

<!DOCTYPE html>
<html lang="en">
@include("partials.head", ["seoTitle"=>"{{seoTitle}}", "seoDescription"=>""])

<body>
    <div id="app">

        <div class="home-container">
            <h2>{{title}}</h2>
            <p>{{shortDescription}}</p>

            <div>
                {{formHtml}}
            </div>

        </div>
    </div>

    @include("partials.footer", [])
</body>

</html>