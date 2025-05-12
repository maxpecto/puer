<?php

namespace App\Providers;

use App\Models\Menu;
use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use App\Models\MenuItem;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Load General Settings directly from DB
        $defaultSettings = (new GeneralSettings())->getDefaults();
        $finalSettings = $defaultSettings; // Start with defaults

        if (Schema::hasTable('settings')) {
            try {
                $settingsRecord = DB::table('settings')
                                    ->where('group', 'general')
                                    ->where('name', 'general') // Spatie'nin varsayılan ayar adı
                                    ->first();

                if ($settingsRecord && !empty($settingsRecord->payload)) {
                    $dbSettings = json_decode($settingsRecord->payload, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        \Illuminate\Support\Facades\Log::error(
                            '[AppServiceProvider] Failed to decode settings payload from DB. JSON Error: ' . json_last_error_msg(), 
                            ['payload' => $settingsRecord->payload]
                        );
                        $dbSettings = []; // Xəta halında boş massivə qayıt
                    }
                    $finalSettings = array_merge($defaultSettings, $dbSettings ?: []);
                }
            } catch (\Exception $e) {
                // Log error if needed, fallback to default settings
                // Log::error('Error loading settings from DB: ' . $e->getMessage());
                // $finalSettings remains $defaultSettings
            }
        }
        View::share('settings', $finalSettings);

        // Load Main Menu
        if (Schema::hasTable('menus') && Schema::hasTable('menu_items')) {
            try {
                $mainMenu = Menu::with(['items' => function ($query) {
                    $query->where('is_active', true)->orderBy('order', 'asc');
                }])
                ->where('slug', 'ana-menu')
                ->first();
                View::share('mainMenu', $mainMenu);
            } catch (\Exception $e) {
                // Log error or handle missing menu
                View::share('mainMenu', null);
            }
        } else {
            View::share('mainMenu', null);
        }

        // Səbətdəki məhsul sayını bütün view-larla paylaş - YENİ ƏLAVƏ EDİLDİ
        View::composer('*', function ($view) {
            $cartItemsCount = 0;
            if (session()->has('cart')) {
                $cartItemsCount = collect(session('cart'))->sum('quantity');
            }
            $view->with('cartItemsCount', $cartItemsCount);
        });
    }
}
