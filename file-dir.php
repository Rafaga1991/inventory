<?php

return [
    'api', // carpeta api
    'asset' => [// carpeta asset
        'css' => [// carpeta css
            'style.css'
        ],
        'js' => [// carpeta js
            'script.js'
        ],
        'image',
        'doc'
    ],
    'view' => [// carpeta vista
        'login' => [// carpeta login
            'index.php'
        ],
        'home' => [
            'index.php',
            'dashboard.php'
        ]
    ],
    'model' => [
        'User.php'
    ],
    'controller' => [// carpeta controlador
        'login' => [// carpeta login
            'LoginController.php'
        ],
        'home' => [
            'EmployeeController.php',
            'HomeController.php'
        ]
    ],
    'route.php',
    'rol.php'
];