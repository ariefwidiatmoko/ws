<?php

namespace App;

class Permission extends \Spatie\Permission\Models\Permission
{

    public static function defaultPermissions()
    {
        return [

            'view_classrooms',
            'add_classrooms',
            'edit_classrooms',
            'delete_classrooms',

            'view_contacts_employees',

            'view_contacts_students',

            'view_employees',
            'add_employees',
            'edit_employees',
            'delete_employees',

            'view_events',
            'add_events',
            'edit_events',
            'delete_events',

            'view_filemanager',

            'view_grades',
            'add_grades',
            'edit_grades',
            'delete_grades',

            'view_lessons',
            'add_lessons',
            'edit_lessons',
            'delete_lessons',

            'view_messages',
            'add_messages',
            'edit_messages',
            'delete_messages',

            'view_months',
            'add_months',
            'edit_months',
            'delete_months',

            'view_notes',
            'add_notes',
            'edit_notes',
            'delete_notes',

            'view_permissions',
            'add_permissions',
            'edit_permissions',

            'view_positions',
            'add_positions',
            'edit_positions',
            'delete_positions',

            'view_profiles',
            'edit_profiles',

            'view_roles',
            'add_roles',
            'edit_roles',
            'delete_roles',

            'view_semesters',
            'add_semesters',
            'edit_semesters',
            'delete_semesters',

            'view_students',
            'add_students',
            'edit_students',
            'delete_students',

            'view_subjects',
            'add_subjects',
            'edit_subjects',
            'delete_subjects',

            'view_users',
            'add_users',
            'edit_users',
            'delete_users',

            'view_years',
            'add_years',
            'edit_years',
            'delete_years',
        ];
    }

    protected $fillable = [
        'name', 'guard_name'
    ];
}
