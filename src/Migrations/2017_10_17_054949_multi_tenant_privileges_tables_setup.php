<?php 
//namespace Trailblazer\MultiTenant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class MultiTenantPrivilegesTablesSetup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();

        // roles table
        Schema::create(Config::get('multitenant.roles_table'), function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('name')->unique();
            $table->bigInteger('tenant_id', false, true )->nullable();
            $table->timestamps();
        });
        // permissions table
        Schema::create(Config::get('multitenant.permissions_table'), function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('name')->unique();
            $table->bigInteger('tenant_id', false, true )->nullable();
            $table->timestamps();
        });

        // permission_role table  to store role permissions(Many-to-Many)
        Schema::create(Config::get('multitenant.permission_role_table'), function (Blueprint $table) {
            $table->bigInteger('role_id', false, true )->nullable();
            $table->bigInteger('permission_id', false, true )->nullable();
            $table->bigInteger('tenant_id', false, true )->nullable();


            $table->foreign('role_id')
            ->references('id')
            ->on(Config::get('multitenant.roles_table'))
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('permission_id')
            ->references('id')
            ->on(Config::get('multitenant.permissions_table'))
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->primary(['permission_id', 'role_id', 'tenant_id']);
        });

        // permission_user table  to store role permissions(Many-to-Many)
        Schema::create(Config::get('multitenant.permission_user_table'), function (Blueprint $table) {
            $table->bigInteger('user_id', false, true )->nullable();
            $table->bigInteger('permission_id', false, true )->nullable();
            $table->bigInteger('tenant_id', false, true )->nullable();


            $table->foreign('user_id')
            ->references('id')
            ->on(Config::get('multitenant.users_table'))
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('permission_id')
            ->references('id')
            ->on(Config::get('multitenant.permissions_table'))
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->primary(['user_id', 'permission_id', 'tenant_id']);
        });

        // role_user table to store user roles (Many-to-Many)
        Schema::create(Config::get('multitenant.role_user_table'), function (Blueprint $table) {
            $table->bigInteger('user_id', false, true )->nullable();
            $table->bigInteger('role_id', false, true )->nullable();
            $table->bigInteger('tenant_id', false, true )->nullable();

            $table->foreign('user_id')
            ->references(Config::get('multitenant.user_key'))
            ->on(Config::get('multitenant.users_table'))
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('role_id')
            ->references('id')
            ->on(Config::get('multitenant.roles_table'))
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->primary(['user_id', 'role_id', 'tenant_id']);
        });

        // privilege_details table to store Things like display_name and description for roles and permissions.
        Schema::create(Config::get('multitenant.privilege_details_table'), function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('owner_type', 500);
            $table->bigInteger('owner_id', false, true );
            $table->string('lang', 10);
            $table->string('key');
            $table->string('value');
        });

        DB::commit();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(Config::get('multitenant.privilege_details_table'));
        Schema::drop(Config::get('multitenant.permission_role_table'));
        Schema::drop(Config::get('multitenant.permissions_table'));
        Schema::drop(Config::get('multitenant.role_user_table'));
        Schema::drop(Config::get('multitenant.roles_table'));
    }
}