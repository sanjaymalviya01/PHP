<?php
session_start();
if (count($_SESSION) === 0) {
    header('Location: ../login.php');
} else {
    header('Location: ./user/dashboard.php');
}
