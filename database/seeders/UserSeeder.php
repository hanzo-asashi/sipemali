<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        // Ask for db migration refresh, default is no
        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {
            // Call the php artisan migrate:refresh
            $this->command->call('migrate:refresh');
            $this->command->warn('Semua data telah dibersihkan, mulai dari database kosong.');
        }

        // Seed the default permissions
        $permissions = Permission::defaultPermissions();

        foreach ($permissions as $perms) {
            Permission::firstOrCreate($perms);
        }

        $this->command->info('Default Permissions ditambahkan.');

        // Confirm roles needed
        if ($this->command->confirm('Buat Roles untuk pengguna, default adalah superadmin, admin, operator and user? [y|N]', true)) {

            // Ask for roles from input
            $input_roles = $this->command->ask('Masukkan roles dalam format koma sesudah roles.', 'superadmin,admin,operator,user');

            // Explode roles
            $roles_array = explode(',', $input_roles);

            // add roles
            foreach ($roles_array as $role) {
                $role = Role::firstOrCreate(['name' => trim($role)]);

                if ($role->name == 'superadmin') {
                    // assign all permissions
                    $role->syncPermissions(Permission::all());
                    $this->command->info('Super Admin diberikan akses penuh');
                } elseif ($role->name == 'admin') {
                    // assign some permissions
                    $role->syncPermissions(Permission::where('name', 'LIKE', 'show %')
                        ->orWhere('name', 'LIKE', 'create %')
                        ->orWhere('name', 'LIKE', 'manage %')
                        ->orWhere('name', 'LIKE', 'detail %')
                        ->orWhere('name', 'LIKE', 'restore %')
                        ->orWhere('name', 'LIKE', 'backup %')
                        ->orWhere('name', 'LIKE', 'eksport %')
                        ->orWhere('name', 'LIKE', 'import %')
                        ->orWhere('name', 'LIKE', 'bulk-actions %')
                        ->orWhere('name', 'LIKE', 'update %')->get());
                    $this->command->info('Admin diberikan beberapa akses');
                } elseif ($role->name == 'operator') {
                    // assign some permissions
                    $role->syncPermissions(Permission::where('name', 'LIKE', 'show %')
                        ->orWhere('name', 'LIKE', 'create %')
                        ->orWhere('name', 'LIKE', 'eksport %')
                        ->orWhere('name', 'LIKE', 'import %')
                        ->orWhere('name', 'LIKE', 'detail %')->get());
                    $this->command->info('Operator juga diberikan beberapa akses');
                } else {
                    // for others by default only read access
                    $role->syncPermissions(Permission::where('name', 'LIKE', 'show %')
                        ->orWhere('name', 'LIKE', 'detail %')
                        ->get());
                }

                // create one user for each role
                $this->createUser($role, $faker);
            }

            $this->command->info('Roles '.$input_roles.' berhasil ditambahkan');
        } else {
            $role = Role::firstOrCreate(['name' => 'superadmin']);
            $role->syncPermissions(Permission::all());
            $this->command->info('Hanya menambahkan default superadmin akses dengan hak akses penuh');
        }
    }

    /**
     * Create a user with given role.
     *
     * @param $role
     */
    private function createUser($role, Generator $faker)
    {
        $user = User::factory()->create();
        $user->assignRole($role->name);

        if ($role->name == 'superadmin') {
            $this->command->info('Ini adalah detail akses anda untuk login:');
            $this->command->warn($user->email);
            $this->command->warn('Kata sandi adalah "password"');
        }
    }
}
