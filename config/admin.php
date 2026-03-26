<?php

return [
    'title' => 'Simple Admin',
    'name' => '<b>Simple</b> Admin',
    'route_prefix' => 'admin',
    'route_name_prefix' => 'admin.',
    'middleware' => ['web', 'auth'],
    'auth_guard' => 'web',

    /*
    |--------------------------------------------------------------------------
    | Admin Menu Structure
    |--------------------------------------------------------------------------
    | Разделы и подразделы админки
    | Для каждого пункта:
    | - title: отображаемое название
    | - icon: необязательно
    | - route: маршрут (имя или прямой URL)
    | - permission: какое разрешение нужно (role / policy)
    | - children: вложенные пункты
    |--------------------------------------------------------------------------
    */

    'menu' => [
        [
            'title'      => 'dashboard',
            'icon'       => 'bi bi-columns-gap',
            'route'      => 'admin.dashboard',
            'permission' => 'view_dashboard'
        ],
        // [
        //     'title'      => 'projects',
        //     'icon'       => 'bi bi-briefcase',
        //     'route'      => 'admin.projects.index',
        //     'permission' => 'view_projects',
        // ],
        [
            'title'       => 'media',
            'icon'       => 'bi bi-image',
            'route'      => 'admin.media.index',
            'permission' => 'view_media',
        ],
        [
            'title'       => 'users',
            'icon'       => 'bi bi-people',
            'route'      => 'admin.users.index',
            'permission' => 'manage_users',
        ],
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Permissions mapping (используется для генерации seed'ов / проверки)
    |--------------------------------------------------------------------------
    */
    'permissions' => [
        'view_dashboard',
        'view_activity',
        'view_media',
        'upload_media',
        'manage_media',
        'manage_media_folders',
        'manage_users',
        'manage_roles',
        'manage_settings',
        'manage_seo',
        'manage_integrations',
        'view_analytics',
        'manage_webhooks',
        'view_audit',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default roles (name => permissions)
    |--------------------------------------------------------------------------
    */
    'roles' => [
        'admin' => [
            'label' => 'Administrator',
            'permissions' => ['*'], // wildcard = all permissions
        ],
        'editor' => [
            'label' => 'Editor',
            'permissions' => [
                'view_dashboard',
                'view_activity',
                'view_media',
                'upload_media',
            ],
        ],
        'viewer' => [
            'label' => 'Viewer',
            'permissions' => [
                'view_dashboard',
                'view_media',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Media (spatie/laravel-medialibrary) defaults & limits
    |--------------------------------------------------------------------------
    */
    'media' => [

        // Disk to use for media (must match filesystems.php)
        'disk' => env('ADMIN_MEDIA_DISK', env('FILESYSTEM_DRIVER', 's3')),

        // Default collections used by admin UI and API
        'collections' => [
            'library' => [
                'single' => false,
                'accepts' => ['image/jpeg','image/png','image/webp','image/avif'],
            ],
            'gallery' => [
                'single' => false,
                'accepts' => ['image/jpeg','image/png','image/webp'],
            ],
            'cover' => [
                'single' => true,
                'accepts' => ['image/jpeg','image/png','image/webp'],
            ],
            'icon' => [
                'single' => true,
                'accepts' => ['image/svg+xml', 'image/jpeg','image/png','image/webp'],
            ],
        ],

        // Validation / limits (in kilobytes)
        'max_file_size_kb' => env('ADMIN_MEDIA_MAX_FILE_KB', 5120), // 5 MB default
        'accepted_mimes' => ['jpg','jpeg','png','webp','avif', 'svg'],

        // Whether to use signed presigned URLs for direct S3 upload
        'direct_upload' => env('ADMIN_MEDIA_DIRECT_UPLOAD', true),

        // responsive/conversion settings (names used in registerMediaConversions)
        'conversions' => [
            'thumb' => ['width' => 400, 'height' => 300],
            'small' => ['width' => 640, 'height' => null],
            'medium' => ['width' => 1200, 'height' => null],
            'webp' => ['format' => 'webp'],
        ],

        // Generate conversions synchronously in dev by default; in prod use queues
        'conversions_non_queued' => env('ADMIN_MEDIA_CONVERSIONS_NON_QUEUED', false),

        // Default custom properties to expose in API
        'default_custom_properties' => ['alt','caption','credit'],

    ],

    /*
    |--------------------------------------------------------------------------
    | API settings for admin endpoints
    |--------------------------------------------------------------------------
    */
    'api' => [
        'prefix' => 'api/' . env('ADMIN_ROUTE_PREFIX', 'admin'),
        'throttle' => env('ADMIN_API_THROTTLE', '60,1'), // requests per minute
        'pagination' => [
            'default' => 20,
            'max' => 200,
        ],
        'response' => [
            'wrap' => 'data', // top-level wrapper name for json responses
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Upload & Storage helper settings
    |--------------------------------------------------------------------------
    */
    'upload' => [
        'tmp_dir' => storage_path('app/tmp'),
        'presign_ttl_minutes' => env('ADMIN_PRESIGN_TTL', 10),
        'allowed_preview_extensions' => ['jpg','jpeg','png','webp','svg'],
    ],

    /*
    |--------------------------------------------------------------------------
    | UI / UX settings
    |--------------------------------------------------------------------------
    */
    'ui' => [
        'theme' => env('ADMIN_UI_THEME', 'light'), // light | dark | system
        'items_per_page_options' => [10, 20, 50, 100],
        'default_items_per_page' => 20,
        'date_format' => env('ADMIN_DATE_FORMAT', 'Y-m-d H:i'),
        'time_zone' => env('ADMIN_TIMEZONE', config('app.timezone')),
        'sidebar_collapsed_by_default' => false,
        'show_help_quickstart' => true,
        'logo' => env('ADMIN_UI_LOGO', '/assets/img/logo-admin.svg'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Dashboard widgets (order, enabled)
    |--------------------------------------------------------------------------
    */
    'dashboard' => [
        'widgets' => [
            ['key' => 'projects_count', 'title' => 'Projects', 'enabled' => true, 'order' => 1],
            ['key' => 'recent_activity', 'title' => 'Recent activity', 'enabled' => true, 'order' => 2],
            ['key' => 'media_storage', 'title' => 'Media usage', 'enabled' => true, 'order' => 3],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Integrations (placeholders, not active until configured)
    |--------------------------------------------------------------------------
    */
    'integrations' => [
        'analytics' => [
            'provider' => env('ADMIN_ANALYTICS_PROVIDER', 'none'), // google, fathom, matomo, none
            'id' => env('ADMIN_ANALYTICS_ID', null),
        ],
        'cdn' => [
            'url' => env('ADMIN_CDN_URL', null),
            'enabled' => env('ADMIN_CDN_ENABLED', false),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Feature toggles
    |--------------------------------------------------------------------------
    */
    'features' => [
        'enable_audit_log' => env('ADMIN_FEATURE_AUDIT_LOG', true),
        'enable_multilanguage' => env('ADMIN_FEATURE_MULTI_LANG', false),
        'enable_responsive_images' => env('ADMIN_FEATURE_RESPONSIVE_IMAGES', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Policies / Gate mapping (model => policy)
    |--------------------------------------------------------------------------
    */
    'policies' => [
        // 'App\\Models\\Project' => 'App\\Policies\\ProjectPolicy',
        // 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media' => 'App\\Policies\\MediaPolicy',
    ],

    /*
    |--------------------------------------------------------------------------
    | Seeder defaults (useful for artisan db:seed)
    |--------------------------------------------------------------------------
    */
    'seed' => [
        'default_admin' => [
            'first_name' => env('ADMIN_SEED_FIRST_NAME', 'Administrator'),
            'last_name' => env('ADMIN_SEED_LAST_NAME', 'Administrator'),
            'email' => env('ADMIN_SEED_EMAIL', 'admin@example.com'),
            'password' => env('ADMIN_SEED_PASSWORD', 'password'), // override in env for prod
            'role' => 'super admin',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Misc / housekeeping
    |--------------------------------------------------------------------------
    */
    'cleanup' => [
        'delete_orphan_media_after_days' => env('ADMIN_CLEANUP_DELETE_ORPHAN_MEDIA_AFTER_DAYS', 30),
        'backup_schedule' => env('ADMIN_BACKUP_CRON', '0 3 * * *'),
    ],
];