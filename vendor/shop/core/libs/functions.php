<?php

function debug($data = '', $title = '')
{
    echo "<mark>{$title}</mark>";
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
