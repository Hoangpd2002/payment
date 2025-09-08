<?php

namespace hoangpd\payment;

use hoangpd\payment\Commands\paymentCommand;
use Hoangpd\Payment\Services\VietQrGenerator;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class paymentServiceProvider extends PackageServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Đăng ký service VietQR
        $this->app->singleton(VietQrGenerator::class);
        $this->app->alias(VietQrGenerator::class, 'vietqr');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Nếu có route, config, migration thì load ở đây
        // $this->loadRoutesFrom(__DIR__.'/../routes/vietqr.php');
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('payment')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_payment_table')
            ->hasCommand(paymentCommand::class);
    }
}
