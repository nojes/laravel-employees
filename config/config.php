<?php

use \nojes\employees\database\seeds\EmployeePositionTableSeeder;

/*
 * Set specific configuration variables here
 */
return [
    // automatic loading of routes through main service provider
    'routes' => true,

    /*
    |--------------------------------------------------------------------------
    | The path where the package views are stored.
    | ('{package-path}/resources/views/' by default)
    |--------------------------------------------------------------------------
    */
    'views_path' => 'resources/views/vendor/employees/',

    'publish' => [
        'views' => false,
        'migrations' => false,
        'seeds' => false,
        'factories' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Config for seeders.
    |--------------------------------------------------------------------------
    */
    'seeds' => [
        'employee' => [
            'count' => 100,
        ],
        'position' => [
            'once' => true,
            'method' => EmployeePositionTableSeeder::INSERT_METHOD,
            'titles' => [
                'Accessibility Specialist',
                'Agile Project Manager',
                'Business Systems Analyst',
                'Cloud Architect',
                'Computer Graphics Animator',
                'Computer Network Architect',
                'Computer Support Specialist',
                'Content Manager',
                'Content Strategist',
                'Data Analyst',
                'Data Architect',
                'Data Modeler',
                'Data Scientist',
                'Database Administrator',
                'Database Administrator',
                'Designer',
                'DevOps Manager',
                'Digital Marketing Manager',
                'Frameworks Specialist',
                'Front-End Designer',
                'Front-End Developer',
                'Full-Stack Developer',
                'Game Developer',
                'Growth Hacker',
                'Information Architect',
                'Information Security Analyst',
                'Interaction Designer',
                'Marketing Technologist',
                'Mobile App Developer',
                'Mobile Developer',
                'Product Manager',
                'Project Lead',
                'QA (Quality Assurance) Specialist',
                'Security Specialist',
                'SEO Consultant',
                'Social Media Manager',
                'Software Developer',
                'Systems Administrator',
                'Systems Engineer',
                'Technical Account Manager',
                'Technical Lead',
                'UI Designer',
                'UX Designer',
                'Web Analytics Developer',
            ]
        ]
    ]
];
