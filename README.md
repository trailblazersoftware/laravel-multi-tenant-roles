# Laravel Multi-Tenant Roles
This Laravel 5.5+ package provides an implementation of roles and permissions in a multi-tenant application.
It borrows a lot from [Entrust](https://github.com/Zizaco/entrust). Although all the Entrust functionalities are not yet implemented here, the roadmap includes doing so.
The intend is for Laravel Multi-Tenant Roles to provide the following improvement (over Entrust):
* ## Multi-Tenancy "out of the box".
* ## Localization. Being able to provide a display name and descriptions for a role or permission in whatever language your Laravel application supports.
# Installation
To install, simply run the command below in your terminal.

```composer require "trailblazersoftware/multi-tenant:dev-master"```
# Setup
Multi Tenant uses Laravel's Auto-Discovery feature to register its Service Provider, and allow you to run its migration and publish its config file.
## Publish The Config File
Run the following artisan command:

```php artisan vendor:publish --provider="Trailblazer\MultiTenant\MultiTenantServiceProvider"```

Or, you can type even less by simply typing ```php artisan vendor:publish``` and selecting the number corresponding to `Trailblazer\MultiTenant\MultiTenantServiceProvider`
## Update The Config File
After running the `vendor:publish` command, you'll see a new config file `MultiTenant.php` in your `projects_root/config` directory.

<table>
    <thead>
        <tr>
            <th>Config Key</th>
            <th>Default</th>
            <th>Description</th>
            <th>Required</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>'role'</td>
            <td>'App\Models\Users\Role'</td>
            <td>The Role model</td>
            <td>Yes</td>
        </tr>
        <tr>
            <td>'roles_table'</td>
            <td>'roles'</td>
            <td>The table where role models are stored</td>
            <td>Yes</td>
        </tr>
        <tr>
            <td>'users_table'</td>
            <td>'users'</td>
            <td>The table where user models are stored</td>
            <td>Yes</td>
        </tr>
        <tr>
            <td>'user_key'</td>
            <td>'id'</td>
            <td>The primary key for the user model</td>
            <td>Yes</td>
        </tr>
        <tr>
            <td>'role_user_table'</td>
            <td>'role_user'</td>
            <td>The pivot table where users' roles are stored</td>
            <td>Yes</td>
        </tr>
        <tr>
            <td>'role_user_table'</td>
            <td>'role_user'</td>
            <td>The pivot table where users' roles are stored</td>
            <td>Yes</td>
        </tr>
        <tr>
            <td>'permission'</td>
            <td>'role_user'</td>
            <td>The pivot table where users' roles are stored</td>
            <td>Yes</td>
        </tr>
    </tbody>
</table>
# Work in progress
