<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Disco del sistema de archivos predeterminado
    |--------------------------------------------------------------------------
    |
    | Aquí puede especificar el disco del sistema de archivos predeterminado que debe usarse
    | por el marco. El disco "local", así como una variedad de
    | Los discos basados ​​en discos están disponibles para su aplicación. ¡Solo guárdalo!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Disco de sistema de archivos en la nube predeterminado
    |--------------------------------------------------------------------------
    |
    | Muchas aplicaciones almacenan archivos tanto localmente como en la nube. Para esto
    | Por este motivo, puede especificar un controlador "nube" predeterminado aquí. Este conductor
    | se vinculará como la implementación del disco en la nube en el contenedor.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Discos del sistema de archivos
    | ------------------------------------------------- -------------------------
    |
    | Aquí puede configurar tantos "discos" de sistema de archivos como desee, y
    | incluso puede configurar varios discos del mismo controlador. Los valores predeterminados tienen
    | configurado para cada controlador como ejemplo de las opciones necesarias.
    |
    | Controladores compatibles: "local", "ftp", "sftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'users' => [
            'driver' => 'local',
            'root' => storage_path('app/users'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'images' => [
            'driver' => 'local',
            'root' => storage_path('app/images'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
        ],

    ],

];
