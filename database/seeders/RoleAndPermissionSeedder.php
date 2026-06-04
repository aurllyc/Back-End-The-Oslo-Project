<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleAndPermissionSeedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $guard = 'api';

        // create permissions in variable
        $permissions = [
            // all roles
            'view dashboard',
            'view notification',
            'manage profile',
            'manage settings',

            // mhs/student
            'mhs:apply intership',
            'mhs:view vacancies',
            'mhs:fill logbook',
            'mhs:submit final report',
            'mhs:give feedback',
            'mhs:view grades',

            // prodi
            'prodi:validate application',
            'prodi:manage students',
            'prodi:manage dospem',
            'prodi:manage mitra',
            'prodi:manage vacancies',
            'prodi:monitor internship',
            'prodi:assign supervisor',
            'prodi:view statistics',
            'prodi:export data',

            // dospem
            'dospem:view guided students',
            'dospem:monitor logbook',
            'dospem:validate and feedback',
            'dospem:manage monitoring',
            'dospem:write monitoring notes',
            'dospem:submit final grade',
            'dospem:view reports',

            // mitra
            'mitra:manage company profile',
            'mitra:manage vacancies',
            'mitra:view intership students',
            'mitra:monitor student logbook',
            'mitra:evaluate and grade',
            'mitra:give student feedback',
            'mitra:view company reports',
        ];

        // Simpan permission yang dibuat ke dalam collection/array untuk mempermudah assignment
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => $guard
            ]);
        }

        $roleMhs = Role::firstOrCreate(['name' => 'mhs', 'guard_name' => $guard]);
        $roleMhs->givePermissionTo([
            'view dashboard',
            'view notification',
            'manage profile',
            'manage settings',
            'mhs:apply intership',
            'mhs:view vacancies',
            'mhs:fill logbook',
            'mhs:submit final report',
            'mhs:give feedback',
            'mhs:view grades',
        ]);

        $roleProdi = Role::firstOrCreate(['name' => 'prodi', 'guard_name' => $guard]);
        $roleProdi->givePermissionTo( [
            'view dashboard',
            'view notification',
            'manage profile',
            'manage settings',
            'prodi:validate application',
            'prodi:manage students',
            'prodi:manage dospem',
            'prodi:manage mitra',
            'prodi:manage vacancies',
            'prodi:monitor internship',
            'prodi:assign supervisor',
            'prodi:view statistics',
            'prodi:export data',
        ]);

        $roleDospem = Role::firstOrCreate(['name' => 'dospem', 'guard_name' => $guard]);
        $roleDospem->givePermissionTo( [
            'view dashboard',
            'view notification',
            'manage profile',
            'manage settings',
            'dospem:view guided students',
            'dospem:monitor logbook',
            'dospem:validate and feedback',
            'dospem:manage monitoring',
            'dospem:write monitoring notes',
            'dospem:submit final grade',
            'dospem:view reports',
        ]);

        $roleMitra = Role::firstOrCreate(['name' => 'mitra', 'guard_name' => $guard]);
        $roleMitra->givePermissionTo([
            'view dashboard',
            'view notification',
            'manage profile',
            'manage settings',
            'mitra:manage company profile',
            'mitra:manage vacancies',
            'mitra:view intership students',
            'mitra:monitor student logbook',
            'mitra:evaluate and grade',
            'mitra:give student feedback',
            'mitra:view company reports',
        ]);

        // user simulation
        $userPassword = bcrypt('password');

        // Pastikan User menggunakan assignRole dengan objek Role utuh agar guard-nya sinkron
        User::firstOrCreate(
            ['email' => 'mhs@example.com'],
            ['name' => 'Mahasiswa', 'password' => $userPassword]
        )->assignRole($roleMhs);

        User::firstOrCreate(
            ['email' => 'prodi@example.com'],
            ['name' => 'Prodi', 'password' => $userPassword]
        )->assignRole($roleProdi);

        User::firstOrCreate(
            ['email' => 'dospem@example.com'],
            ['name' => 'Dosen Pembimbing', 'password' => $userPassword]
        )->assignRole($roleDospem);

        User::firstOrCreate(
            ['email' => 'mitra@example.com'],
            ['name' => 'Mitra', 'password' => $userPassword]
        )->assignRole($roleMitra);
    }
}
