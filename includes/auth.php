<?php
session_start();
require_once 'db.php';

function login($username, $password) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM Ipa_users WHERE Ipa_user_username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['Ipa_user_password'])) {
        $_SESSION['authUser'] = $user['Ipa_user_ID'];
        $_SESSION['userGroup'] = $user['Ipa_user_group'];
        $_SESSION['userName'] = $user['Ipa_user_firstname'] . ' ' . $user['Ipa_user_lastname'];
        $_SESSION['userStatus'] = $user['Ipa_inv_status'];
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