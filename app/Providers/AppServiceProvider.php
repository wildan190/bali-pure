<?php

namespace App\Providers;

use App\Repositories\Interface\CategoryRepositoryInterface;
use App\Repositories\Interface\ProductRepositoryInterface;
use App\Repositories\Interface\GalleryRepositoryInterface;
use App\Repositories\GalleryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;

use Midtrans\Config;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
    $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    $this->app->bind(GalleryRepositoryInterface::class, GalleryRepository::class);
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production');
    Config::$isSanitized = true;
    Config::$is3ds = true;
  }
}
