11111<?php
require_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/str_convert.php';

$slocation = sql_read('select * from location');
debug($slocation);

?>2222