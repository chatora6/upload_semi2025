<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
function checkAuthority() {
    return $_SESSION['user_role'] ?? 'guest';
}

function isAdmin() {
    return checkAuthority() === 'admin';
}