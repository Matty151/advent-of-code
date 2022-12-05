<?php

require_once '../vendor/autoload.php';

function prettyPrint($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}

function prettyPrintR($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function printHr()
{
    echo '<hr/>';
}

(new \Challenges\Year2022\Day1\Day1())->run();
