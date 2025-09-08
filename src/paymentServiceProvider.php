<?php

namespace hoangpd\payment;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class paymentServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * Đăng ký tên package (tuỳ bạn đặt)
         * Ví dụ: hoangpd/payment
         */
        $package
            ->name('payment')
            ->hasConfigFile()   // nếu bạn có config, không có cũng được
            ->hasViews()        // nếu package có view
            ->hasMigration('create_payment_table'); // nếu package có migration
    }

    public function packageBooted(): void
    {
        // Đăng ký singleton service
        $this->app->singleton(VietQrGenerator::class, function ($app) {
            return new VietQrGenerator;
        });

        // Alias để dùng kiểu: app('vietqr')
        $this->app->alias(VietQrGenerator::class, 'vietqr');
    }
}
