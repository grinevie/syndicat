<?php

$promocodes = include_once 'promocodes.php';

echo in_array($_GET['promocode'], $promocodes) ? 'true' : 'false';
