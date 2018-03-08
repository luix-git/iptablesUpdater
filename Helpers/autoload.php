<?php

spl_autoload_register(function ($class_name) {
    if (substr($class_name, 0, 3) == 'App') {
        include __DIR__ . '/..' . str_replace('\\', '/', substr_replace($class_name, '', 0, 3)) . '.php';
    }
});