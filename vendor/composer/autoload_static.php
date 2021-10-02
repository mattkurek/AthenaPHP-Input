<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf8df8e44ad7f69d713eaefaf427694b8
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Mattkurek\\AthenaIphpInput\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Mattkurek\\AthenaIphpInput\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitf8df8e44ad7f69d713eaefaf427694b8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf8df8e44ad7f69d713eaefaf427694b8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf8df8e44ad7f69d713eaefaf427694b8::$classMap;

        }, null, ClassLoader::class);
    }
}
