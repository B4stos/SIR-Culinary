<?php

use Controllers\ProcessarLoginController;

require_once(__DIR__."/Middlewares/validarsession.php");
require_once(__DIR__."/Controllers/ProcessarLoginController.php");

(new ProcessarLoginController())->processologin();

?>