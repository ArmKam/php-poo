<?php

// render('article/show')
function render(string $path, array $variables = [])
{
    //"var1"=> 2, "varZ" = "Lior"
    // $var1 => 2
    //$var2 => "Lior
    extract($variables); // this methode does extracte the variables

    ob_start();
    require('templates/' . $path . '.html.php');
    $pageContent = ob_get_clean();

    require('templates/layout.html.php');
}

// redierct ("index.php");
function redirect(string $url): void
{
    header("Location: " . $url);
    exit();
}
