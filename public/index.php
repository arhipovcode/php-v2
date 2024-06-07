<?php
require '../services/autoloader/Autoloader.php';

use models\catalog\Catalogs;
use models\product\Product;
use services\autoloader\Autoloader;

spl_autoload_register([new Autoloader(), 'loadClass']);

$catalog = new Catalogs();
//$product = new Product();
$catalog = $catalog->getById(13);

//echo "<script src='test.js'></script>";
