<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbae2044f8aa24658b9320d6acd0c13e6
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Mam\\MeetingRoom\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Mam\\MeetingRoom\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbae2044f8aa24658b9320d6acd0c13e6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbae2044f8aa24658b9320d6acd0c13e6::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
