<?php

function testMdp(string $mdp)
{
    $isValidLength = strlen($mdp) > 8 && strlen($mdp) < 14;
    $isValidMdp = preg_match('/^[^"\'\\<>@]+$/i', $mdp);
    return $isValidLength && $isValidMdp;
}

function testTelephone(string $telephone)
{
    return preg_match('/^[\d]{6,12}$/i', $telephone);
}


?>