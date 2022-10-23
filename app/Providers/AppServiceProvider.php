<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Blade::directive('jsassets', function ($file) {
            return "<?php echo '<script src='{frontend_assets($file)}'></script>'; ?>";
        });
        Blade::directive("menu",function ($expression) {
            list($page,$class) = explode("," , $expression);
            return "<?php echo active_menu({$page},{$class}) ?>" ;
        });

        Blade::directive("homeMenu",function ($expression) {
            return "<?php echo active_menu_home({$expression}) ?>" ;
        });

        Blade::directive("menuAny",function ($expression){
            list($pages,$class) = explode("," , $expression);
            return "<?php echo active_menu_any({$pages},{$class}) ?>" ;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
