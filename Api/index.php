<?php


define('ROOTPATH', __DIR__);

require __DIR__ . '/Core/Core.php';

Core::init();
Core::$Default_core->launch();


