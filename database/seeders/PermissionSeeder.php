<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Bookings
            'booking-list',
            'booking-save-page',
            'booking-save',
            'booking-update',
            'booking-delete',

            // Countries
            'country-list',
            'country-save-page',
            'country-save',
            'country-update',
            'country-delete',

            // Reviews
            'review-list',
            'review-save-page',
            'review-save',
            'review-update',
            'review-delete',

            // Service Categories
            'service-category-list',
            'service-category-save-page',
            'save-service-category',
            'update-service-category',
            'delete-service-category',

            // Services
            'service-list',
            'service-save-page',
            'save-service',
            'update-service',
            'delete-service',

            // Students
            'student-list',
            'student-save-page',
            'student-save',
            'student-update',
            'student-delete',

            // Success Stories
            'success-stories-list',
            'success-stories-save-page',
            'success-stories-save',
            'success-stories-update',
            'success-stories-delete',

            //roles
            'list-role',
            'role-save-page',
            'create-role',
            'update-role',
            'delete-role',

            //users
            'list-user',
            'user-save-page',
            'create-user',
            'update-user',
            'delete-user',

            //page contents
            'page-content-list',
            'page-content-save-page',
            'page-content-save',
            'page-content-update',
            'page-content-delete',

            //logo
            'list-logo',
            'logo-save-page',
            'create-logo',
            'update-logo',
            'delete-logo',

            //universities
            'university-list',
            'university-save-page',
            'university-save',
            'university-update',
            'university-delete',

            //country details
            'country-detail-list',
            'country-detail-save-page',
            'country-detail-save',
            'country-detail-update',
            'country-detail-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
