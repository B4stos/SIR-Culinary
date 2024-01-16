<?php

use Controllers\PerfilPageController;

#require_once(DIR."/Middlewares/validarsession.php");
require_once(__DIR__."/Controllers/PerfilControllerPage.php");

(new PerfilPageController())->index();

?>