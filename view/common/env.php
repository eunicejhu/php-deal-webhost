<?php
require_once("../../src/util/DotEnv.php");
(new DotEnv(dirname(__DIR__, 2) . "/.env"))->load();
?>