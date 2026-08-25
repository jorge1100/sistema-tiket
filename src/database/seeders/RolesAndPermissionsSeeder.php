<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]
            ->forgetCachedPermissions();
        // -------------------------
        // PERMISOS
        // -------------------------
        $crear = Permission::firstOrCreate([
            'name' => 'crear tickets'
        ]);
        $ver = Permission::firstOrCreate([
            'name' => 'ver tickets'
        ]);
        $editar = Permission::firstOrCreate([
            'name' => 'editar tickets'
        ]);
        $cerrar = Permission::firstOrCreate([
            'name' => 'cerrar tickets'
        ]);
        $gestionarUsuarios = Permission::firstOrCreate([
            'name' => 'gestionar usuarios'
        ]);
        // -------------------------
        // ROLES
        // -------------------------
        $admin = Role::firstOrCreate([
            'name' => 'admin'
        ]);
        $supervisor = Role::firstOrCreate([
            'name' => 'supervisor'
        ]);
        $usuario = Role::firstOrCreate([
            'name' => 'usuario'
        ]);

        #----------------------------------
        # creacion de roles y permisos
        #----------------------------------

        $adminUser = User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('123456789'),
            ]
        );
        $adminUser->syncRoles(['admin']);
        $supervisorUser = User::firstOrCreate(
            ['email' => 'supervisor@test.com'],
            [
                'name' => 'Supervisor',
                'password' => Hash::make('123456789'),
            ]
        );
        $supervisorUser->syncRoles(['supervisor']);
        $normalUser = User::firstOrCreate(
            ['email' => 'usuario@test.com'],
            [
                'name' => 'Usuario',
                'password' => Hash::make('123456789'),
            ]
        );
        $normalUser->syncRoles(['usuario']);

        // -------------------------
        // PERMISOS DEL ADMIN
        // -------------------------
        $admin->syncPermissions([
            $crear,
            $ver,
            $editar,
            $cerrar,
            $gestionarUsuarios,
        ]);
        // -------------------------
        // PERMISOS DEL SUPERVISOR
        // -------------------------
        $supervisor->syncPermissions([
            $crear,
            $ver,
            $editar,
            $cerrar,
        ]);
        // -------------------------
        // PERMISOS DEL USUARIO
        // -------------------------
        $usuario->syncPermissions([
            $crear,
            $ver,
        ]);
    }
}
