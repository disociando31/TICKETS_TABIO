<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Ticket;
use App\Models\Soporte;
use App\Models\Solicitud;
use App\Policies\TicketPolicy;
use App\Policies\SoportePolicy;
use App\Policies\SolicitudPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Ticket::class => TicketPolicy::class,
        Soporte::class => SoportePolicy::class,
        Solicitud::class => SolicitudPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
