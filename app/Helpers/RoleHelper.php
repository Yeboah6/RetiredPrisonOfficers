<?php

namespace App\Helpers;

class RoleHelper 
{
    /**
     * Check if user has specific role(s)
     */
    public static function hasRole($roles) 
    {
        $userRole = session('userRole');
        
        // Check if userRole exists and is not null
        if (!$userRole) {
            return false;
        }
        
        // If $roles is a string, convert to array
        if (is_string($roles)) {
            $roles = [$roles];
        }
        
        // Ensure $roles is an array
        if (!is_array($roles)) {
            return false;
        }
        
        return in_array($userRole, $roles);
    }
    
    /**
     * Check if user is super admin
     */
    public static function isSuperAdmin() 
    {
        return session('userRole') === 'super_admin';
    }
    
    /**
     * Check if user is admin or super admin
     */
    public static function isAdmin() 
    {
        $userRole = session('userRole');
        return $userRole && in_array($userRole, ['admin', 'super_admin']);
    }
    
    /**
     * Check if user is manager, admin, or super admin
     */
    public static function isManager() 
    {
        $userRole = session('userRole');
        return $userRole && in_array($userRole, ['manager', 'admin', 'super_admin']);
    }
    
    /**
     * Check if user is regular user or employee
     */
    public static function isUser() 
    {
        $userRole = session('userRole');
        return $userRole && in_array($userRole, ['user', 'employee']);
    }
    
    /**
     * Get current user role
     */
    public static function getCurrentRole() 
    {
        return session('userRole');
    }
    
    /**
     * Check if user is authenticated
     */
    public static function isAuthenticated() 
    {
        return session('loginId') && session('userRole');
    }
}