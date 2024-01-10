<?php

use Controllers\HomePageController;

require_once(__DIR__."/Middlewares/validarsession.php");
require_once(__DIR__."/Controllers/HomePageController.php");

(new HomePageController())->index();

?>