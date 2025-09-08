<?php

namespace hoangpd\payment;

use hoangpd\payment\Commands\paymentCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class paymentServiceProvider extends PackageServiceProvider
{
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
