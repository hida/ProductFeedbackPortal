<?php 

class Autoloader {
    public static function register() {
        spl_autoload_register(function ($className) {           
            $classMap = [
                'Client\\' => 'src/Client/',
                
            ];

            foreach ($classMap as $namespace => $path) {
                if (strpos($className, $namespace) === 0) {
                    $relativeClass = substr($className, strlen($namespace));
                    $filePath = $path . str_replace('\\', '/', $relativeClass) . '.php';
                    if (file_exists($filePath)) {
                        require $filePath;
                        return;
                    }
                }
            }
        });
    }
}

Autoloader::register();
