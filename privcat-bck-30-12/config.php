<?php

require_once 'utils.php';

define('DEBUG', false);
define('TESTING', false);
define('APPLICATION_LOG_FILE', 'log.txt');

// Application root folder
define('APP_ROOT', str_replace("\\","/",getcwd()));

// Application folder
define('APP_DIR', APP_ROOT. '/application');

// Smarty PATH setup
define('SMARTY_DIR', APP_ROOT . '/lib/smarty/');

define('SMRTY_TMPLT_DIR',	APP_ROOT	. '/application/templates/');
define('SMRTY_TMPLT_C_DIR',	APP_ROOT	. '/cache/smarty/templates_c/');
define('SMRTY_CNFG_DIR',	APP_ROOT	. '/config/smarty/');
define('SMRTY_CACHE_DIR',	APP_ROOT	. '/cache/smarty/');


// Application settings
define('APPLICATION_NAME', 'Privkaty');

// Database support:
//  * MySQL 5 and higher
//  * PostgreSQL 8 and higher
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_USER', 'adppoland3_35');
define('DB_PASS', 'Rw#TjA94Vv8&S@2#u%!3');
define('DB_NAME', 'adppoland3_35');