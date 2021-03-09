<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /* Las asignaciones de políticas para la aplicación */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /*  Registre cualquier servicio de autenticación    */
    public function boot()  {
        $this->registerPolicies();

    }
}
