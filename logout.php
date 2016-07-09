<?php
/**
 * Created by PhpStorm.
 * User: avner
 * Date: 09/07/16
 * Time: 09:03
 */

session_start();
session_destroy();
echo "<script>window.location.href='/';</script>";
exit;