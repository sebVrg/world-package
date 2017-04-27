<?php 

use FindCode\Api\View\PackageView;
use FindCode\Api\Controller\PackageController;
use FindCode\Api\Model\PackageModel;

require "../vendor/autoload.php";

header("Content-Type: application /json; charset=utf8");

 echo (new PackageController(
 new PackageModel(),
 new PackageView())
 )->execute();
 