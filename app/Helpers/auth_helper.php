<?php

function hasRole($requiredRole)
{
    // Ensure user is logged in
    if (!session()->has('isLoggedIn') || session()->get('isLoggedIn') !== true) {
        return false;
    }

    // Retrieve user role_id from session
    $roleId = session()->get('role_id');

    // Map role IDs to names, or fetch from DB
    // For simplicity, let's say:
    // 1 => Admin, 2 => Manager, 3 => Employee
    // You can also do a DB lookup if you prefer dynamic role mapping
    switch ($roleId) {
        case 1:
            $userRole = 'Admin';
            break;
        case 2:
            $userRole = 'Manager';
            break;
        case 3:
        default:
            $userRole = 'Employee';
            break;
    }

    return ($userRole === $requiredRole);
}
