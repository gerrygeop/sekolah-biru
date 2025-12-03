<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\User;

class SpatiePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gather resource names from app/Policies directory
        $policyPath = app_path('Policies');
        $resources = [];

        if (File::isDirectory($policyPath)) {
            $files = File::files($policyPath);
            foreach ($files as $file) {
                $name = $file->getFilenameWithoutExtension();
                if (Str::endsWith($name, 'Policy')) {
                    $resource = Str::replaceLast('Policy', '', $name);
                    $resources[] = $resource;
                }
            }
        }

        // Default operations mirrored from policies in the project
        $operations = [
            'ViewAny',
            'View',
            'Create',
            'Update',
            'Delete',
            'Restore',
            'ForceDelete',
            'ForceDeleteAny',
            'RestoreAny',
            'Replicate',
            'Reorder'
        ];

        DB::transaction(function () use ($resources, $operations) {
            // Create permissions for each resource
            foreach ($resources as $resource) {
                foreach ($operations as $op) {
                    $name = "$op:$resource";
                    DB::table('permissions')->updateOrInsert(
                        ['name' => $name, 'guard_name' => 'web'],
                        ['name' => $name, 'guard_name' => 'web']
                    );
                }
            }

            // Create an admin role and give all permissions
            $roleId = DB::table('roles')->updateOrInsert(
                ['name' => 'super_admin', 'guard_name' => 'web'],
                ['name' => 'super_admin', 'guard_name' => 'web']
            );

            $role = DB::table('roles')->where('name', 'super_admin')->first();
            $permissions = DB::table('permissions')->pluck('id')->toArray();

            // Sync role_has_permissions
            DB::table('role_has_permissions')->where('role_id', $role->id)->delete();
            $rows = array_map(function ($pid) use ($role) {
                return ['permission_id' => $pid, 'role_id' => $role->id];
            }, $permissions);
            if (!empty($rows)) {
                DB::table('role_has_permissions')->insert($rows);
            }

            // Optionally assign role to first user or ADMIN_EMAIL
            $adminEmail = env('ADMIN_EMAIL');
            $user = null;
            if ($adminEmail) {
                $user = User::where('email', $adminEmail)->first();
            }
            if (!$user) {
                $user = User::first();
            }

            if ($user) {
                // remove previous model role rows and attach
                DB::table('model_has_roles')->where('model_id', $user->id)->delete();
                DB::table('model_has_roles')->insert([
                    'role_id' => $role->id,
                    'model_type' => User::class,
                    'model_id' => $user->id,
                ]);
            }
        });
    }
}
