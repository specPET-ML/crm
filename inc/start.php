<?php
include($_SERVER['DOCUMENT_ROOT'].'/config.php');

echo "\n".constant("DB_USERNAME")."\n";
echo constant("DB_PASSWORD")."\n";
echo constant("DB_NAME")."\n";
echo getcwd() . "\n";
?>