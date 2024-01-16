<?php

declare(strict_types=1);

namespace PackageVersions;

use Composer\InstalledVersions;
use OutOfBoundsException;

class_exists(InstalledVersions::class);

/**
 * This class is generated by composer/package-versions-deprecated, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 *
 * @deprecated in favor of the Composer\InstalledVersions class provided by Composer 2. Require composer-runtime-api:^2 to ensure it is present.
 */
final class Versions
{
    /**
     * @deprecated please use {@see self::rootPackageName()} instead.
     *             This constant will be removed in version 2.0.0.
     */
    const ROOT_PACKAGE_NAME = 'laravel/laravel';

    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    const VERSIONS          = array (
  'asm89/stack-cors' => 'v2.2.0@50f57105bad3d97a43ec4a485eb57daf347eafea',
  'backpack/crud' => '4.1.71@03a0ad4a8d7182d6ee9cf9c86d784d171a942484',
  'backpack/logmanager' => 'v4.0.11@420922f3bf8d70e5af6efa9e2e504b65e7f2b1eb',
  'backpack/menucrud' => '2.0.5@fd6d5f3744ef091867f286fe91ff17c965a355a3',
  'backpack/pagemanager' => '3.2.0@1b996dac92115c92c2c713770c7a9f6ce7283554',
  'backpack/permissionmanager' => '6.0.11@656e8abc468a2fe6713a5ea4ad3b2e146bd8141b',
  'backpack/settings' => '3.1.0@026b56bd4274ad62a5225f9f82cea47713be22a6',
  'brick/math' => '0.9.3@ca57d18f028f84f777b2168cd1911b0dee2343ae',
  'carbonphp/carbon-doctrine-types' => '1.0.0@3c430083d0b41ceed84ecccf9dac613241d7305d',
  'cocur/slugify' => 'v4.5.0@af8e6ee771458bf885f7457807b5ff9bad8743cb',
  'composer/package-versions-deprecated' => '1.11.99.5@b4f54f74ef3453349c24a845d22392cd31e65f1d',
  'composer/semver' => '3.4.0@35e8d0af4486141bc745f23a29cc2091eb624a32',
  'creativeorange/gravatar' => 'v1.0.23@3a1b227c48091b039b967265ec13c0800c70ac79',
  'cviebrock/eloquent-sluggable' => '8.0.8@16e21db24d80180f870c3c7c4faf3d3af23f4117',
  'doctrine/cache' => '2.2.0@1ca8f21980e770095a31456042471a57bc4c68fb',
  'doctrine/dbal' => '3.3.8@f873a820227bc352d023791775a01f078a30dfe1',
  'doctrine/deprecations' => '1.1.2@4f2d4f2836e7ec4e7a8625e75c6aa916004db931',
  'doctrine/event-manager' => '1.2.0@95aa4cb529f1e96576f3fda9f5705ada4056a520',
  'doctrine/inflector' => '2.0.8@f9301a5b2fb1216b2b08f02ba04dc45423db6bff',
  'doctrine/lexer' => '1.2.3@c268e882d4dbdd85e36e4ad69e02dc284f89d229',
  'dragonmantank/cron-expression' => 'v3.3.3@adfb1f505deb6384dc8b39804c5065dd3c8c8c0a',
  'egulias/email-validator' => '2.1.25@0dbf5d78455d4d6a41d186da50adc1122ec066f4',
  'ezyang/htmlpurifier' => 'v4.17.0@bbc513d79acf6691fa9cf10f192c90dd2957f18c',
  'fruitcake/laravel-cors' => 'v2.2.0@783a74f5e3431d7b9805be8afb60fd0a8f743534',
  'graham-campbell/result-type' => 'v1.1.2@fbd48bce38f73f8a4ec8583362e732e4095e5862',
  'guzzlehttp/guzzle' => '7.8.1@41042bc7ab002487b876a0683fc8dce04ddce104',
  'guzzlehttp/promises' => '2.0.2@bbff78d96034045e58e13dedd6ad91b5d1253223',
  'guzzlehttp/psr7' => '2.6.2@45b30f99ac27b5ca93cb4831afe16285f57b8221',
  'lab404/laravel-impersonate' => '1.7.4@d8ab69f05daab4117b313e11ca007fbf3199a1ab',
  'laravel/framework' => 'v8.83.27@e1afe088b4ca613fb96dc57e6d8dbcb8cc2c6b49',
  'laravel/sanctum' => 'v2.15.1@31fbe6f85aee080c4dc2f9b03dc6dd5d0ee72473',
  'laravel/serializable-closure' => 'v1.3.3@3dbf8a8e914634c48d389c1234552666b3d43754',
  'laravel/tinker' => 'v2.8.2@b936d415b252b499e8c3b1f795cd4fc20f57e1f3',
  'league/commonmark' => '1.6.7@2b8185c13bc9578367a5bf901881d1c1b5bbd09b',
  'league/flysystem' => '1.1.10@3239285c825c152bcc315fe0e87d6b55f5972ed1',
  'league/mime-type-detection' => '1.12.0@c7f2872fb273bf493811473dafc88d60ae829f48',
  'maatwebsite/excel' => '3.1.51@6d3c78ce6645abada32e03b40dc7f3c561878bc3',
  'maennchen/zipstream-php' => '3.1.0@b8174494eda667f7d13876b4a7bfef0f62a7c0d1',
  'markbaker/complex' => '3.0.2@95c56caa1cf5c766ad6d65b6344b807c1e8405b9',
  'markbaker/matrix' => '3.0.1@728434227fe21be27ff6d86621a1b13107a2562c',
  'moneyphp/money' => 'v3.3.3@0dc40e3791c67e8793e3aa13fead8cf4661ec9cd',
  'monolog/monolog' => '2.9.2@437cb3628f4cf6042cc10ae97fc2b8472e48ca1f',
  'nesbot/carbon' => '2.72.1@2b3b3db0a2d0556a177392ff1a3bf5608fa09f78',
  'nikic/php-parser' => 'v4.17.1@a6303e50c90c355c7eeee2c4a8b27fe8dc8fef1d',
  'opis/closure' => '3.6.3@3d81e4309d2a927abbe66df935f4bb60082805ad',
  'phpoffice/phpspreadsheet' => '1.29.0@fde2ccf55eaef7e86021ff1acce26479160a0fa0',
  'phpoption/phpoption' => '1.9.2@80735db690fe4fc5c76dfa7f9b770634285fa820',
  'prologue/alerts' => '0.4.8@a6412e318c0171526bc8b25ef597f2cc61f5b800',
  'psr/cache' => '1.0.1@d11b50ad223250cf17b86e38383413f5a6764bf8',
  'psr/clock' => '1.0.0@e41a24703d4560fd0acb709162f73b8adfc3aa0d',
  'psr/container' => '1.1.1@8622567409010282b7aeebe4bb841fe98b58dcaf',
  'psr/event-dispatcher' => '1.0.0@dbefd12671e8a14ec7f180cab83036ed26714bb0',
  'psr/http-client' => '1.0.3@bb5906edc1c324c9a05aa0873d40117941e5fa90',
  'psr/http-factory' => '1.0.2@e616d01114759c4c489f93b099585439f795fe35',
  'psr/http-message' => '2.0@402d35bcb92c70c026d1a6a9883f06b2ead23d71',
  'psr/log' => '1.1.4@d49695b909c3b7628b6289db5479a1c204601f11',
  'psr/simple-cache' => '1.0.1@408d5eafb83c57f6365a3ca330ff23aa4a5fa39b',
  'psy/psysh' => 'v0.11.22@128fa1b608be651999ed9789c95e6e2a31b5802b',
  'ralouphie/getallheaders' => '3.0.3@120b605dfeb996808c31b6477290a714d356e822',
  'ramsey/collection' => '1.2.2@cccc74ee5e328031b15640b51056ee8d3bb66c0a',
  'ramsey/uuid' => '4.2.3@fc9bb7fb5388691fd7373cd44dcb4d63bbcf24df',
  'spatie/laravel-permission' => '5.11.1@7090824cca57e693b880ce3aaf7ef78362e28bbd',
  'swiftmailer/swiftmailer' => 'v6.3.0@8a5d5072dca8f48460fce2f4131fcc495eec654c',
  'symfony/console' => 'v5.4.32@c70df1ffaf23a8d340bded3cfab1b86752ad6ed7',
  'symfony/css-selector' => 'v5.4.26@0ad3f7e9a1ab492c5b4214cf22a9dc55dcf8600a',
  'symfony/deprecation-contracts' => 'v2.5.2@e8b495ea28c1d97b5e0c121748d6f9b53d075c66',
  'symfony/error-handler' => 'v5.4.29@328c6fcfd2f90b64c16efaf0ea67a311d672f078',
  'symfony/event-dispatcher' => 'v5.4.26@5dcc00e03413f05c1e7900090927bb7247cb0aac',
  'symfony/event-dispatcher-contracts' => 'v2.5.2@f98b54df6ad059855739db6fcbc2d36995283fe1',
  'symfony/finder' => 'v5.4.27@ff4bce3c33451e7ec778070e45bd23f74214cd5d',
  'symfony/http-foundation' => 'v5.4.32@cbcd80a4c36f59772d62860fdb0cb6a38da63fd2',
  'symfony/http-kernel' => 'v5.4.33@892636f9279f953dc266dc088f900b03eecb4ffa',
  'symfony/mime' => 'v5.4.26@2ea06dfeee20000a319d8407cea1d47533d5a9d2',
  'symfony/polyfill-ctype' => 'v1.28.0@ea208ce43cbb04af6867b4fdddb1bdbf84cc28cb',
  'symfony/polyfill-iconv' => 'v1.28.0@6de50471469b8c9afc38164452ab2b6170ee71c1',
  'symfony/polyfill-intl-grapheme' => 'v1.28.0@875e90aeea2777b6f135677f618529449334a612',
  'symfony/polyfill-intl-idn' => 'v1.28.0@ecaafce9f77234a6a449d29e49267ba10499116d',
  'symfony/polyfill-intl-normalizer' => 'v1.28.0@8c4ad05dd0120b6a53c1ca374dca2ad0a1c4ed92',
  'symfony/polyfill-mbstring' => 'v1.28.0@42292d99c55abe617799667f454222c54c60e229',
  'symfony/polyfill-php72' => 'v1.28.0@70f4aebd92afca2f865444d30a4d2151c13c3179',
  'symfony/polyfill-php73' => 'v1.28.0@fe2f306d1d9d346a7fee353d0d5012e401e984b5',
  'symfony/polyfill-php80' => 'v1.28.0@6caa57379c4aec19c0a12a38b59b26487dcfe4b5',
  'symfony/polyfill-php81' => 'v1.28.0@7581cd600fa9fd681b797d00b02f068e2f13263b',
  'symfony/process' => 'v5.4.28@45261e1fccad1b5447a8d7a8e67aa7b4a9798b7b',
  'symfony/routing' => 'v5.4.33@5b5b86670f947db92ab54cdcff585e76064d0b04',
  'symfony/service-contracts' => 'v2.5.2@4b426aac47d6427cc1a1d0f7e2ac724627f5966c',
  'symfony/string' => 'v5.4.32@91bf4453d65d8231688a04376c3a40efe0770f04',
  'symfony/translation' => 'v5.4.31@ba72f72fceddf36f00bd495966b5873f2d17ad8f',
  'symfony/translation-contracts' => 'v2.5.2@136b19dd05cdf0709db6537d058bcab6dd6e2dbe',
  'symfony/var-dumper' => 'v5.4.29@6172e4ae3534d25ee9e07eb487c20be7760fcc65',
  'tijsverkoyen/css-to-inline-styles' => 'v2.2.7@83ee6f38df0a63106a9e4536e3060458b74ccedb',
  'vlucas/phpdotenv' => 'v5.6.0@2cf9fb6054c2bb1d59d1f3817706ecdb9d2934c4',
  'voku/portable-ascii' => '1.6.1@87337c91b9dfacee02452244ee14ab3c43bc485a',
  'webmozart/assert' => '1.11.0@11cb2199493b2f8a3b53e7f19068fc6aac760991',
  'backpack/generators' => 'v3.1.13@ca7f840d43de6e649fd2b22ef9a37cb2459dbc21',
  'barryvdh/laravel-debugbar' => 'v3.7.0@3372ed65e6d2039d663ed19aa699956f9d346271',
  'doctrine/instantiator' => '1.5.0@0a0fa9780f5d4e507415a065172d26a98d02047b',
  'facade/flare-client-php' => '1.10.0@213fa2c69e120bca4c51ba3e82ed1834ef3f41b8',
  'facade/ignition' => '2.17.7@b4f5955825bb4b74cba0f94001761c46335c33e9',
  'facade/ignition-contracts' => '1.0.2@3c921a1cdba35b68a7f0ccffc6dffc1995b18267',
  'fakerphp/faker' => 'v1.20.0@37f751c67a5372d4e26353bd9384bc03744ec77b',
  'filp/whoops' => '2.15.4@a139776fa3f5985a50b509f2a02ff0f709d2a546',
  'hamcrest/hamcrest-php' => 'v2.0.1@8c3d0a3f6af734494ad8f6fbbee0ba92422859f3',
  'laravel/sail' => 'v1.19.0@4f230634a3163f3442def6a4e6ffdb02b02e14d6',
  'maximebf/debugbar' => 'v1.19.1@03dd40a1826f4d585ef93ef83afa2a9874a00523',
  'mockery/mockery' => '1.6.6@b8e0bb7d8c604046539c1115994632c74dcb361e',
  'myclabs/deep-copy' => '1.11.1@7284c22080590fb39f2ffa3e9057f10a4ddd0e0c',
  'nunomaduro/collision' => 'v5.11.0@8b610eef8582ccdc05d8f2ab23305e2d37049461',
  'phar-io/manifest' => '2.0.3@97803eca37d319dfa7826cc2437fc020857acb53',
  'phar-io/version' => '3.2.1@4f7fd7836c6f332bb2933569e566a0d6c4cbed74',
  'phpunit/php-code-coverage' => '9.2.29@6a3a87ac2bbe33b25042753df8195ba4aa534c76',
  'phpunit/php-file-iterator' => '3.0.6@cf1c2e7c203ac650e352f4cc675a7021e7d1b3cf',
  'phpunit/php-invoker' => '3.1.1@5a10147d0aaf65b58940a0b72f71c9ac0423cc67',
  'phpunit/php-text-template' => '2.0.4@5da5f67fc95621df9ff4c4e5a84d6a8a2acf7c28',
  'phpunit/php-timer' => '5.0.3@5a63ce20ed1b5bf577850e2c4e87f4aa902afbd2',
  'phpunit/phpunit' => '9.6.15@05017b80304e0eb3f31d90194a563fd53a6021f1',
  'sebastian/cli-parser' => '1.0.1@442e7c7e687e42adc03470c7b668bc4b2402c0b2',
  'sebastian/code-unit' => '1.0.8@1fc9f64c0927627ef78ba436c9b17d967e68e120',
  'sebastian/code-unit-reverse-lookup' => '2.0.3@ac91f01ccec49fb77bdc6fd1e548bc70f7faa3e5',
  'sebastian/comparator' => '4.0.8@fa0f136dd2334583309d32b62544682ee972b51a',
  'sebastian/complexity' => '2.0.2@739b35e53379900cc9ac327b2147867b8b6efd88',
  'sebastian/diff' => '4.0.5@74be17022044ebaaecfdf0c5cd504fc9cd5a7131',
  'sebastian/environment' => '5.1.5@830c43a844f1f8d5b7a1f6d6076b784454d8b7ed',
  'sebastian/exporter' => '4.0.5@ac230ed27f0f98f597c8a2b6eb7ac563af5e5b9d',
  'sebastian/global-state' => '5.0.6@bde739e7565280bda77be70044ac1047bc007e34',
  'sebastian/lines-of-code' => '1.0.3@c1c2e997aa3146983ed888ad08b15470a2e22ecc',
  'sebastian/object-enumerator' => '4.0.4@5c9eeac41b290a3712d88851518825ad78f45c71',
  'sebastian/object-reflector' => '2.0.4@b4f479ebdbf63ac605d183ece17d8d7fe49c15c7',
  'sebastian/recursion-context' => '4.0.5@e75bd0f07204fec2a0af9b0f3cfe97d05f92efc1',
  'sebastian/resource-operations' => '3.0.3@0f4443cb3a1d92ce809899753bc0d5d5a8dd19a8',
  'sebastian/type' => '3.2.1@75e2c2a32f5e0b3aef905b9ed0b179b953b3d7c7',
  'sebastian/version' => '3.0.2@c6c1022351a901512170118436c764e473f6de8c',
  'theseer/tokenizer' => '1.2.2@b2ad5003ca10d4ee50a12da31de12a5774ba6b96',
  'laravel/laravel' => 'dev-main@956630e70d852b76f47734b5c17cc61cd3a4180f',
);

    private function __construct()
    {
    }

    /**
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function rootPackageName() : string
    {
        if (!self::composer2ApiUsable()) {
            return self::ROOT_PACKAGE_NAME;
        }

        return InstalledVersions::getRootPackage()['name'];
    }

    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function getVersion(string $packageName): string
    {
        if (self::composer2ApiUsable()) {
            return InstalledVersions::getPrettyVersion($packageName)
                . '@' . InstalledVersions::getReference($packageName);
        }

        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }

    private static function composer2ApiUsable(): bool
    {
        if (!class_exists(InstalledVersions::class, false)) {
            return false;
        }

        if (method_exists(InstalledVersions::class, 'getAllRawData')) {
            $rawData = InstalledVersions::getAllRawData();
            if (count($rawData) === 1 && count($rawData[0]) === 0) {
                return false;
            }
        } else {
            $rawData = InstalledVersions::getRawData();
            if ($rawData === null || $rawData === []) {
                return false;
            }
        }

        return true;
    }
}
