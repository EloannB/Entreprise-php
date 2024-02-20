<?php

require_once '../config.php';
require_once '../models/Entreprise.php';

if (isset($_GET['validate'])) {
    Entreprise::validateUser($_GET['validate']);
}

if (isset($_GET['invalidate'])) {
    Entreprise::desactivUser($_GET['invalidate']);
}
