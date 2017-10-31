<?php
/**
 * A role & permission management solution for Laravel.
 *
 * @author Kolado Sidibe <kolado.sidibe@olympuscloud.com>
 * @author Trailblazer Software <support@olympuscloud.com>
 * @license MIT
 * @package Trailblazer\MultiTenant
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Role Model
    |--------------------------------------------------------------------------
    |
    | The Role model. Please update this to reflect the actual namespace
    | of your role model
    |
    */
    'role' => 'App\Models\Users\Role',
    /*
    |--------------------------------------------------------------------------
    | Roles Table
    |--------------------------------------------------------------------------
    |
    | The table used to store roles in the database.
    |
    */
    'roles_table' => 'roles',
    /*
    |--------------------------------------------------------------------------
    | User Model
    |--------------------------------------------------------------------------
    |
    | This is the User model.
    | If needed, update this with the proper namespace to reflect your actual User model
    |
    */
    'user' => 'App\Models\Users\User',
    /*
    |--------------------------------------------------------------------------
    | Users Table
    |--------------------------------------------------------------------------
    |
    | The table where users are stored in the database.
    |
    */
    'users_table' => 'users',

    /*
    |--------------------------------------------------------------------------
    | users primary key
    |--------------------------------------------------------------------------
    |
    | This is the primary key on the users table
    |
    */
    'user_key' => 'id',

    /*
    |--------------------------------------------------------------------------
    | role_user Table
    |--------------------------------------------------------------------------
    |
    | The pivot table role_user where user role assignments are stored in the database.
    |
    */
    'role_user_table' => 'role_user',
    /*
    |--------------------------------------------------------------------------
    | Permission Model
    |--------------------------------------------------------------------------
    |
    | If needed, update this with the proper namespace to reflect your actual Permission model
    |
    */
    'permission' => 'App\Models\Users\Permission',
    /*
    |--------------------------------------------------------------------------
    | Permissions Table
    |--------------------------------------------------------------------------
    |
    | The table where permissions are stored in the database.
    |
    */
    'permissions_table' => 'permissions',

    /*
    |--------------------------------------------------------------------------
    | permission_role Table
    |--------------------------------------------------------------------------
    |
    | The pivot table permission_role where roles' permissions are stored in the database.
    |
    */
    'permission_role_table' => 'permission_role',
    
    /*
    |--------------------------------------------------------------------------
    | permission_user Table
    |--------------------------------------------------------------------------
    |
    | The pivot table permission_user where a user's permissions are stored in the database.
    |
    */
    'permission_user_table' => 'permission_user',
    
    /*
    |--------------------------------------------------------------------------
    | privilege_details Table
    |--------------------------------------------------------------------------
    |
    | The pivot table where localized details for roles and permissions are stored.
    | Currently, the 2 details in stored are description and display_name.
    |
    */
    'privilege_details_table' => 'privilege_details'
];