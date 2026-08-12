<?php
    // XAMPP's default MySQL listener is localhost:3306. Change only these
    // values if your XAMPP MySQL configuration uses a different port/password.
    $HOSTNAME = '127.0.0.1';
    $PORT     = 3307;
    $USERNAME = 'root';
    $PASSWORD = '';
    $DATABASE = 'flexigo';

    // Keep connection failures from becoming an opaque PHP 8 exception.
    mysqli_report(MYSQLI_REPORT_OFF);
    $con = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE, $PORT);
    if (!$con) {
        $message = mysqli_connect_error();
        die('FlexiGo could not connect to MySQL. Start MySQL in XAMPP and verify '
            . "server.php (host/port/password). MySQL reported: " . htmlspecialchars($message));
    }
?>
