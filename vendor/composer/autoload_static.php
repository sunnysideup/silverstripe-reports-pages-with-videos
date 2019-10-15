<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita79ff272cafcfa255696248e026583d8
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Sunnysideup\\ReportsPagesWithVideos\\' => 35,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Sunnysideup\\ReportsPagesWithVideos\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Sunnysideup\\ReportsPagesWithVideos\\VideoPages' => __DIR__ . '/../..' . '/src/ReportsPagesWithVideosBaseClass.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita79ff272cafcfa255696248e026583d8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita79ff272cafcfa255696248e026583d8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita79ff272cafcfa255696248e026583d8::$classMap;

        }, null, ClassLoader::class);
    }
}
