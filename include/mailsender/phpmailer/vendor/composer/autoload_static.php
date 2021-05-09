<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit922f0257aa5a3c7d86d675a61863dd63
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit922f0257aa5a3c7d86d675a61863dd63::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit922f0257aa5a3c7d86d675a61863dd63::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit922f0257aa5a3c7d86d675a61863dd63::$classMap;

        }, null, ClassLoader::class);
    }
}
