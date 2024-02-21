<?php

namespace App\Jobs;

use App\Models\Tenant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Stancl\Tenancy\Tenancy;

class SeedAppRolesSeederJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected Tenant $tenant;
    /**
     * Create a new job instance.
     */
    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * Execute the job.
     */
    public function handle(Tenancy $tenancy): void
    {
        // Inicializa el inquilino recién creado
        $tenancy->initialize($this->tenant);

        // Ejecuta el seeder para el inquilino actual
        Artisan::call('db:seed', [
            '--class' => 'Database\Seeders\App\AppRoles\AppRolesSeeder',
        ]);

        // Regresa a la conexión principal
        $tenancy->end();
    }
}
