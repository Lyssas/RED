<?php
error_reporting(-1);

// start a named session
session_name(preg_replace('/[:\.\/-_]/', '', __FILE__));

//inkludera common
include_once("src/common.php");

// time page generation, display in footer. comment out to disable timing.
$pageTimeGeneration = microtime(true);
