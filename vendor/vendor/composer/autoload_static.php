<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit628f9ebab1222f0c7ce96ff0f06515b6
{
    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'Embed\\' => 6,
        ),
        'C' => 
        array (
            'Composer\\CaBundle\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Embed\\' => 
        array (
            0 => __DIR__ . '/..' . '/embed/embed/src',
        ),
        'Composer\\CaBundle\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/ca-bundle/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit628f9ebab1222f0c7ce96ff0f06515b6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit628f9ebab1222f0c7ce96ff0f06515b6::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
