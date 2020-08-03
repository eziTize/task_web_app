<?php



include_once("admin.php");



include_once("teacher.php");



include_once("student.php");



Route::get('cron/run','Cron\CronController@run');