<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3730a6e00851f58e16c14bd5957f2682
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Viniciusbeckerbernardini\\DesafioLeoBackend\\' => 43,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Viniciusbeckerbernardini\\DesafioLeoBackend\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3730a6e00851f58e16c14bd5957f2682::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3730a6e00851f58e16c14bd5957f2682::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3730a6e00851f58e16c14bd5957f2682::$classMap;

        }, null, ClassLoader::class);
    }
}