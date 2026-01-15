<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * =================================================================================================
 *  AppServiceProvider (The "Startup Checklist")
 * =================================================================================================
 * 
 *  ANALOGY:
 *  Think of this as the "Pre-flight Checklist" or the "Morning Routine" of the application.
 *  Before the restaurant opens (app handles a request), we need to set up some global rules
 *  or tools that everyone else might need.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     *  Register any application services.
     * 
     *  ANALOGY:
     *  "I'm packing my bag." 
     *  This is where you bind things into the container, but you don't use them yet 
     *  because other things might not be ready.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     *  Bootstrap any application services.
     * 
     *  ANALOGY:
     *  "I'm arriving at work and turning on the lights."
     *  Everything is loaded now, so we can actually start running code to configure things.
     *
     * @return void
     */
    public function boot()
    {
        // MANUAL VITE DIRECTIVE EXPLANATION:
        // This code teaches Blade (the template engine) a new trick called '@vite'.
        // It's like teaching a chef a new recipe.
        // The directive checks if we are running in "Developer Mode" (hot file exists) or "Production Mode" (manifest.json).
        // Developer Mode: Use the live server for instant updates.
        // Production Mode: Use the compiled, optimized files.
        \Illuminate\Support\Facades\Blade::directive('vite', function ($expression) {
            return "<?php echo \App\Providers\AppServiceProvider::viteTags({$expression}); ?>";
        });
    }

    /**
     * Generate tags for Vite resources.
     *
     * @param string|array $files
     * @return string
     */
    public static function viteTags($files)
    {
        if (is_string($files)) {
            $files = [$files];
        }

        $publicPath = public_path();
        $hotFile = $publicPath . '/hot';
        $html = '';

        if (file_exists($hotFile)) {
            $url = file_get_contents($hotFile);
            $url = trim($url);
            $html .= "<script type='module' src='{$url}/@vite/client'></script>";
            foreach ($files as $file) {
                $html .= "<script type='module' src='{$url}/{$file}'></script>";
            }
        } else {
            $manifestPath = $publicPath . '/build/manifest.json';
            if (file_exists($manifestPath)) {
                $manifest = json_decode(file_get_contents($manifestPath), true);
                foreach ($files as $file) {
                    if (isset($manifest[$file])) {
                        $chunk = $manifest[$file];
                        $html .= "<script type='module' src='/build/{$chunk['file']}'></script>";
                        if (isset($chunk['css'])) {
                            foreach ($chunk['css'] as $css) {
                                $html .= "<link rel='stylesheet' href='/build/{$css}'>";
                            }
                        }
                    }
                }
            }
        }

        return $html;
    }
}
