<?php

include_once 'boot.php';

echo checkPromocode($_GET['Promocode']) ? 'true' : 'false';