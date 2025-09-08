<?php
namespace Composer\Autoload;

class ComposerStaticInitdfe27548af6d83b7d428280eae1df087
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
        'App\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitdfe27548af6d83b7d428280eae1df087::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdfe27548af6d83b7d428280eae1df087::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdfe27548af6d83b7d428280eae1df087::$classMap;

        }, null, ClassLoader::class);
    }
}
