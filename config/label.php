<?php
$file = file_get_contents(config_path().'/configuration.json');
$array = json_decode($file);
return $array;