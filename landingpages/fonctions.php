<?php

function redirection($url)
{
    if (headers_sent())
        print('<meta http-equiv="refresh" content="0;URL=' . $url . '">');
    else
        header("Location: $url");
}

function corriger($prenom)
{
    $prenom = strtoupper(substr($prenom, 0, 1)) . strtolower(substr($prenom, 1, strlen($prenom) - 1));
    return $prenom;
}

function moncrypte($mdp)
{
    $mdp_crypt = "";
    for ($i = 0; $i <= strlen($mdp); $i++)
        $mdp_crypt .= ord($mdp[$i]);
    $mdp_crypt .= strlen($mdp);
    return $mdp_crypt;
}
