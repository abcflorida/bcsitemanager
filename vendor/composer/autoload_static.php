<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0c5770f7af16a91f5e2a1a98c9c23cdb
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Abcflorida\\Bcsitemanager\\' => 25,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Abcflorida\\Bcsitemanager\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Abcflorida\\Bcsitemanager\\Controllers\\Admin\\SitemanagersController' => __DIR__ . '/../..' . '/src/Controllers/Admin/SitemanagersController.php',
        'Abcflorida\\Bcsitemanager\\Controllers\\Frontend\\SitemanagersController' => __DIR__ . '/../..' . '/src/Controllers/Frontend/SitemanagersController.php',
        'Abcflorida\\Bcsitemanager\\Handlers\\Sitemanager\\SitemanagerDataHandler' => __DIR__ . '/../..' . '/src/Handlers/Sitemanager/SitemanagerDataHandler.php',
        'Abcflorida\\Bcsitemanager\\Handlers\\Sitemanager\\SitemanagerDataHandlerInterface' => __DIR__ . '/../..' . '/src/Handlers/Sitemanager/SitemanagerDataHandlerInterface.php',
        'Abcflorida\\Bcsitemanager\\Handlers\\Sitemanager\\SitemanagerEventHandler' => __DIR__ . '/../..' . '/src/Handlers/Sitemanager/SitemanagerEventHandler.php',
        'Abcflorida\\Bcsitemanager\\Handlers\\Sitemanager\\SitemanagerEventHandlerInterface' => __DIR__ . '/../..' . '/src/Handlers/Sitemanager/SitemanagerEventHandlerInterface.php',
        'Abcflorida\\Bcsitemanager\\Models\\Sitemanager' => __DIR__ . '/../..' . '/src/Models/Sitemanager.php',
        'Abcflorida\\Bcsitemanager\\Providers\\SitemanagerServiceProvider' => __DIR__ . '/../..' . '/src/Providers/SitemanagerServiceProvider.php',
        'Abcflorida\\Bcsitemanager\\Repositories\\Sitemanager\\SitemanagerRepository' => __DIR__ . '/../..' . '/src/Repositories/Sitemanager/SitemanagerRepository.php',
        'Abcflorida\\Bcsitemanager\\Repositories\\Sitemanager\\SitemanagerRepositoryInterface' => __DIR__ . '/../..' . '/src/Repositories/Sitemanager/SitemanagerRepositoryInterface.php',
        'Abcflorida\\Bcsitemanager\\Validator\\Sitemanager\\SitemanagerValidator' => __DIR__ . '/../..' . '/src/Validator/Sitemanager/SitemanagerValidator.php',
        'Abcflorida\\Bcsitemanager\\Validator\\Sitemanager\\SitemanagerValidatorInterface' => __DIR__ . '/../..' . '/src/Validator/Sitemanager/SitemanagerValidatorInterface.php',
        'Abcflorida\\Bcsitemanager\\Widgets\\Sitemanager' => __DIR__ . '/../..' . '/src/Widgets/Sitemanager.php',
        'CreateSitemanagersTable' => __DIR__ . '/../..' . '/database/migrations/2016_11_22_152042_create_sitemanagers_table.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0c5770f7af16a91f5e2a1a98c9c23cdb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0c5770f7af16a91f5e2a1a98c9c23cdb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0c5770f7af16a91f5e2a1a98c9c23cdb::$classMap;

        }, null, ClassLoader::class);
    }
}
