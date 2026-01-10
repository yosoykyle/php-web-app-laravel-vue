<?php

namespace App\Providers;

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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Illuminate\Support\Facades\Blade::directive('vite', function ($expression) {
            return "<?php
                \$files = $expression;
                \$publicPath = public_path();
                \$hotFile = \$publicPath . '/hot';
                
                if (file_exists(\$hotFile)) {
                    \$url = file_get_contents(\$hotFile);
                    \$url = trim(\$url);
                    \$html = \"<script type='module' src='{\$url}/@vite/client'></script>\";
                    foreach (\$files as \$file) {
                        \$html .= \"<script type='module' src='{\$url}/{\$file}'></script>\";
                    }
                    echo \$html;
                } else {
                    \$manifestPath = \$publicPath . '/build/manifest.json';
                    if (file_exists(\$manifestPath)) {
                        \$manifest = json_decode(file_get_contents(\$manifestPath), true);
                        foreach (\$files as \$file) {
                            if (isset(\$manifest[\$file])) {
                                \$chunk = \$manifest[\$file];
                                echo \"<script type='module' src='/build/{\$chunk['file']}'></script>\";
                                if (isset(\$chunk['css'])) {
                                    foreach (\$chunk['css'] as \$css) {
                                        echo \"<link rel='stylesheet' href='/build/{\$css}'>\";
                                    }
                                }
                            }
                        }
                    }
                }
            ?>";
        });
    }
}
