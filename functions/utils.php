<?php

function debug($data, $die = false)
{
    var_dump($data);
    if ($die) die;
}
