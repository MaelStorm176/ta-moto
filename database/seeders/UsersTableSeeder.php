<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Factory::create();
        if (User::count() === 0) {
            $role = Role::where('name', 'admin')->firstOrFail();

            User::create([
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => Str::random(60),
                'role_id'        => $role->id,
            ]);
        }

        $role_user = Role::where('name', 'user')->firstOrFail();
        $role_consultant = Role::where('name', 'consultant')->firstOrFail();
        $roles = [$role_user, $role_consultant];

        for ($i = 0; $i < 100; $i++) {
            User::create([
                'name'           => $faker->name,
                'email'          => $faker->unique()->safeEmail,
                'password'       => bcrypt('password'),
                'remember_token' => Str::random(60),
                'role_id'        => $roles[array_rand($roles)]->id,
            ]);
        }
    }
}
