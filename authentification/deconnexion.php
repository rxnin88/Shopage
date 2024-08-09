<?php
session_start();
session_destroy();
require("../fonctions.php");
redirection("../dist/index.php");
