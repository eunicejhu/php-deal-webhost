<?php
function getNow()
{
    date_default_timezone_set("Europe/Paris");
    return date("Y-m-d H:i:s");
}

?>