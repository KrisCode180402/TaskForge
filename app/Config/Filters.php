<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to make reading things easier.
     */
    public $aliases = [
        'csrf'    => \CodeIgniter\Filters\CSRF::class,
        'toolbar' => \CodeIgniter\Filters\DebugToolbar::class,
        'auth'    => \App\Filters\AuthFilter::class,  // Added auth filter alias
    ];

    /**
     * List of filter classes that are always applied before and after every request.
     */
    public $globals = [
        'before' => [
            // 'csrf',
        ],
        'after'  => [
            'toolbar',
        ],
    ];

    /**
     * Methods that should have the filter applied to them.
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any before or after URI patterns.
     */
    public $filters = [];
}
