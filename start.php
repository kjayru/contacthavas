<?php error_reporting(E_ALL & ~E_NOTICE);
session_start();
require 'config.php';
require dirname(__FILE__).'/vendor/autoload.php';
use Models\Database;


new Database();
