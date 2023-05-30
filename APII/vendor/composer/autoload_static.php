<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfd6c95fac5ce4a4981faddb8569d3b6a
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Vittor\\Api\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Vittor\\Api\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfd6c95fac5ce4a4981faddb8569d3b6a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfd6c95fac5ce4a4981faddb8569d3b6a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfd6c95fac5ce4a4981faddb8569d3b6a::$classMap;

        }, null, ClassLoader::class);
    }
}