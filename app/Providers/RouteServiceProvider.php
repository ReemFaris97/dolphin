<?php

namespace App\Providers;

use App\Models\AccountingSystem\AccountingPurchase;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = "App\Http\Controllers";
    protected $distributorNameSpace = "App\Http\Controllers\Distributor";
    protected $apiNamespace = "App\Http\Controllers\Api";
    protected $apiDistributorNamespace = "App\Http\Controllers\Api\Distributor";
    protected $apiSupplierNamespace = "App\Http\Controllers\Api\Supplier";
    protected $supplierNameSpace = "App\Http\Controllers\Supplier";
    protected $AccountingNameSpace = "App\Http\Controllers\AccountingSystem";
    protected $companyNameSpace = "App\Http\Controllers\AccountingSystem\AccountingCompanies";
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
        $this->mapCompanyRoutes();
        $this->mapAdminRoutes();
        $this->mapDistributorRoutes();
        $this->mapDistributorAdminRoutes();
        $this->mapSupplierAdminRoutes();
        $this->mapSupplierRoutes();
        $this->mapAccountingSystemRoutes();
        $this->mapSuppliersApiRoutes();
        //
    }

    /**
     * Define the "company" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapCompanyRoutes()
    {
        Route::group(
            [
                "middleware" => ["web", "company", "auth:accounting_companies"],
                "prefix" => "company",
                "as" => "company.",
                "namespace" => $this->companyNameSpace,
            ],
            function ($router) {
                require base_path("routes/company.php");
            }
        );
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware("web")
            ->namespace($this->namespace)
            ->group(base_path("routes/web.php"));
    }

    protected function mapAdminRoutes()
    {
        Route::middleware("web")
            ->namespace($this->namespace . "\Admin")
            ->as("admin.")
            ->prefix("admins")
            ->group(base_path("routes/admin.php"));
    }

    protected function mapDistributorAdminRoutes()
    {
        Route::middleware("web")
            ->namespace($this->distributorNameSpace)
            ->as("distributor.")
            ->prefix("distributor")
            ->group(base_path("routes/distributor.php"));
    }

    protected function mapAccountingSystemRoutes()
    {
        Route::middleware("web")
            ->namespace($this->AccountingNameSpace)
            ->as("accounting.")
            ->prefix("accounting")
            ->group(base_path("routes/accounting.php"));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix("api")
            ->middleware("api")
            ->namespace($this->apiNamespace)
            ->group(base_path("routes/Api/api.php"));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapDistributorRoutes()
    {
        Route::prefix("api/distributor")
            ->middleware("api")
            ->namespace($this->apiDistributorNamespace)
            ->group(base_path("routes/Api/distributor.php"));
    }

    public function mapSupplierRoutes()
    {
        Route::prefix("api/supplier")
            ->middleware("api")
            ->namespace($this->apiSupplierNamespace)
            ->group(base_path("routes/Api/supplier.php"));
    }

    protected function mapSupplierAdminRoutes()
    {
        Route::middleware("web")
            ->namespace($this->supplierNameSpace)
            ->as("supplier.")
            ->prefix("supplier")
            ->group(base_path("routes/supplier.php"));
    }
    protected function mapSuppliersApiRoutes()
    {
        Route::middleware(["api", "customHandler"])
            ->as("api.suppliers.")
            ->prefix("api/suppliers")
            ->group(base_path("routes/Suppliers/supplier.php"));
    }
}
