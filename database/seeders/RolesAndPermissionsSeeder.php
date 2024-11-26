<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // Permissions array
        $permissions = [
            // Payment method management
            'view payment methods',
            'create payment methods',
            'update payment methods',
            'delete payment methods',

            // User account management
            'view user accounts',
            'create user accounts',
            'update user accounts',
            'delete user accounts',

            // Verification management
            'verify email',
            'verify phone',
            'verify identity',

            // Transaction management
            'approve transactions',
            'reject transactions',
            'view transaction details',

            // Fee and rate management
            'view currency rates',
            'update currency rates',
            'view transaction fees',
            'update transaction fees',

            // Reports and statements
            'view account statements',
            'generate reports',

            // System settings
            'view system settings',
            'update system settings',

            // Notification management
            'manage notifications',
            'view notifications',
            'send notifications',

            // Role and permission management
            'view roles',
            'create roles',
            'update roles',
            'delete roles',
            'assign permissions',

            // Security settings
            'update security settings',
            'manage two-factor authentication',

            // Customer support
            'view support tickets',
            'respond to support tickets',
            'manage live chat',

            // Referral management
            'view referrals',
            'manage referral rewards',

            // Audit logs
            'view audit logs',
            'manage audit logs',

            // Existing permissions
            'view balance',
            'deposit funds',
            'withdraw funds',
            'view transactions',
            'internal transfer',
            'convert currency',
            'manage users',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            // Only create the permission if it doesn't already exist
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }

        // Create roles
        $admin = Role::create(['name' => 'admin']);
        $customer = Role::create(['name' => 'customer']);

        // Assign permissions to admin
        $adminPermissions = [
            'view balance',
            'view transactions',
            'internal transfer',
            'convert currency',
            'manage users',
            'view payment methods',
            'create payment methods',
            'update payment methods',
            'delete payment methods',
            'view user accounts',
            'create user accounts',
            'update user accounts',
            'delete user accounts',
            'verify email',
            'verify phone',
            'verify identity',
            'approve transactions',
            'reject transactions',
            'view transaction details',
            'view currency rates',
            'update currency rates',
            'view transaction fees',
            'update transaction fees',
            'view account statements',
            'generate reports',
            'view system settings',
            'update system settings',
            'manage notifications',
            'view notifications',
            'send notifications',
            'view roles',
            'create roles',
            'update roles',
            'delete roles',
            'assign permissions',
            'update security settings',
            'manage two-factor authentication',
            'view support tickets',
            'respond to support tickets',
            'manage live chat',
            'view referrals',
            'manage referral rewards',
            'view audit logs',
            'manage audit logs'
        ];

        foreach ($adminPermissions as $permission) {
            $admin->givePermissionTo($permission);
        }

        // Assign permissions to customer
        $customerPermissions = [
            'view balance',
            'deposit funds',
            'withdraw funds',
            'view transactions',
            'internal transfer',
            'convert currency',
            'view payment methods',
            'view system settings',
        ];

        foreach ($customerPermissions as $permission) {
            $customer->givePermissionTo($permission);
        }
    }
}
