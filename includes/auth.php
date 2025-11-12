<?php
session_start();
require_once 'db.php';

function login($username, $password) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM lpa_users WHERE lpa_user_username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($user && password_verify($password, $user['lpa_user_password'])) {
        $_SESSION['authUser'] = $user['lpa_user_ID'];
        $_SESSION['userGroup'] = $user['lpa_user_group'];
        $_SESSION['userName'] = $user['lpa_user_firstname'] . ' ' . $user['lpa_user_lastname'];
        $_SESSION['userStatus'] = $user['lpa_inv_status'];
        return true;
    }
    return false;
}

function isAuthenticated() {
    return isset($_SESSION['authUser']);
}

function isAdmin() {
    return isset($_SESSION['userGroup']) && strtolower($_SESSION['userGroup']) === 'admin';
}
?>