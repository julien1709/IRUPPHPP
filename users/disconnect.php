<?php

    session_abort();
    session_unset();
    $_COOKIE = array();
    session_destroy();

    header('Location: login.php');

?>