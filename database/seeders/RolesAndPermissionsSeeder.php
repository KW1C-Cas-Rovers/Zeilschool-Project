<?php

    namespace Database\Seeders;

//    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use Spatie\Permission\Models\Permission;
    use Spatie\Permission\Models\Role;

    class RolesAndPermissionsSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            $permissions = [
                'view users', 'create users', 'edit users', 'delete users', 'change availability',
                'view courses', 'create courses', 'edit courses', 'delete courses', 'reserve course',
                'view boats', 'create boats', 'edit boats', 'delete boats',
                'create comment', 'edit comment', 'delete comment',
                'manage reservations',
                'view payments',
            ];

            foreach ($permissions as $permission) {
                Permission::firstOrCreate(['name' => $permission]);
            }

            $roles = [
                'Super Admin' =>[],
                'Administrator' => [
                    'view users', 'create users', 'edit users',
                    'view courses', 'create courses', 'edit courses',
                    'view boats', 'create boats', 'edit boats',
                    'create comment', 'edit comment', 'delete comment',
                    'manage reservations',
                    'view payments',
                ],
                'Instructor' => [
                    'change availability',
                ],
                'Student' => [
                    'reserve course',
                ]
            ];

            foreach ($roles as $roleName  => $rolePermissions) {
                $role = Role::firstOrCreate(['name' => $roleName]);
                $role->givePermissionTo($rolePermissions);
            }
        }
    }
