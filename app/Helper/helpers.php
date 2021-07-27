<?php

if (!function_exists("formatDate")){
    function formatDate($date){
        if ($date instanceof \Carbon\Carbon){
            return $date->format("d/m/Y");
        }
    }
}

