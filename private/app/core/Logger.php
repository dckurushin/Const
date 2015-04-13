<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 11/4/2015
 * Time: 6:43 PM
 */

namespace Core;

/**
 * Class Logger
 * @package Core
 * to log errors register the logger(via set_error_handler) and use:
 * trigger_error('testasd', E_USER_NOTICE);
 */
class Logger {
    private static $log_path;

    public function __construct($loggingDir)
    {
        $dateTime = new \DateTime();
        Logger::$log_path = $loggingDir . 'log_'. $dateTime->format('d_m_Y') . '.txt';
    }

    public static function ErrorHandler($errno, $errstr, $errfile, $errline, $errcontext)
    {
        $dateTime = new \DateTime();
        $logMsg = '[' . $dateTime->format('d/m/Y H:i:s') . '] err#' . $errno . ' occurred in ' . $errfile . ':' . $errline . ' - ' . $errstr;
        //option 3: message is appended to the file destination. A newline is not automatically added to the end of the message string.
        error_log($logMsg . PHP_EOL, 3, Logger::$log_path);
    }

    public function LogError($msg)
    {
        $dateTime = new \DateTime();
        $logMsg = '[' . $dateTime->format('d/m/Y H:i:s') . '] ' . $msg;
        //option 3: message is appended to the file destination. A newline is not automatically added to the end of the message string.
        error_log($logMsg . PHP_EOL, 3, Logger::$log_path);
}
}