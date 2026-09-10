<?php

use App\Modules\Admin\AdminServiceProvider;
use App\Modules\Catalog\CatalogServiceProvider;
use App\Modules\Kitchen\KitchenServiceProvider;
use App\Modules\Ordering\OrderingServiceProvider;
use App\Modules\Payments\PaymentsServiceProvider;
use App\Modules\Reporting\ReportingServiceProvider;

return [
    App\Providers\AppServiceProvider::class,

    AdminServiceProvider::class,
    CatalogServiceProvider::class,
    KitchenServiceProvider::class,
    OrderingServiceProvider::class,
    PaymentsServiceProvider::class,
    ReportingServiceProvider::class,
];