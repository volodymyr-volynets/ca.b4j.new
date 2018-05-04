<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5fd98564066d4b0e0ac25ee5cf09fa02
{
    public static $prefixLengthsPsr4 = array (
        'O' => 
        array (
            'OomphInc\\ComposerInstallersExtender\\' => 36,
        ),
        'N' => 
        array (
            'Numbers\\Users\\' => 14,
            'Numbers\\Tenants\\' => 16,
            'Numbers\\Internalization\\' => 24,
            'Numbers\\Frontend\\' => 17,
            'Numbers\\Countries\\' => 18,
            'Numbers\\Backend\\' => 16,
        ),
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'OomphInc\\ComposerInstallersExtender\\' => 
        array (
            0 => __DIR__ . '/..' . '/oomphinc/composer-installers-extender/src',
        ),
        'Numbers\\Users\\' => 
        array (
            0 => __DIR__ . '/..' . '/Numbers/Users',
        ),
        'Numbers\\Tenants\\' => 
        array (
            0 => __DIR__ . '/..' . '/Numbers/Tenants',
        ),
        'Numbers\\Internalization\\' => 
        array (
            0 => __DIR__ . '/..' . '/Numbers/Internalization',
        ),
        'Numbers\\Frontend\\' => 
        array (
            0 => __DIR__ . '/..' . '/Numbers/Frontend',
        ),
        'Numbers\\Countries\\' => 
        array (
            0 => __DIR__ . '/..' . '/Numbers/Countries',
        ),
        'Numbers\\Backend\\' => 
        array (
            0 => __DIR__ . '/..' . '/Numbers/Backend',
        ),
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
    );

    public static $classMap = array (
        'Datamatrix' => __DIR__ . '/..' . '/tecnickcom/tcpdf/include/barcodes/datamatrix.php',
        'PDF417' => __DIR__ . '/..' . '/tecnickcom/tcpdf/include/barcodes/pdf417.php',
        'QRcode' => __DIR__ . '/..' . '/tecnickcom/tcpdf/include/barcodes/qrcode.php',
        'TCPDF' => __DIR__ . '/..' . '/tecnickcom/tcpdf/tcpdf.php',
        'TCPDF2DBarcode' => __DIR__ . '/..' . '/tecnickcom/tcpdf/tcpdf_barcodes_2d.php',
        'TCPDFBarcode' => __DIR__ . '/..' . '/tecnickcom/tcpdf/tcpdf_barcodes_1d.php',
        'TCPDF_COLORS' => __DIR__ . '/..' . '/tecnickcom/tcpdf/include/tcpdf_colors.php',
        'TCPDF_FILTERS' => __DIR__ . '/..' . '/tecnickcom/tcpdf/include/tcpdf_filters.php',
        'TCPDF_FONTS' => __DIR__ . '/..' . '/tecnickcom/tcpdf/include/tcpdf_fonts.php',
        'TCPDF_FONT_DATA' => __DIR__ . '/..' . '/tecnickcom/tcpdf/include/tcpdf_font_data.php',
        'TCPDF_IMAGES' => __DIR__ . '/..' . '/tecnickcom/tcpdf/include/tcpdf_images.php',
        'TCPDF_IMPORT' => __DIR__ . '/..' . '/tecnickcom/tcpdf/tcpdf_import.php',
        'TCPDF_PARSER' => __DIR__ . '/..' . '/tecnickcom/tcpdf/tcpdf_parser.php',
        'TCPDF_STATIC' => __DIR__ . '/..' . '/tecnickcom/tcpdf/include/tcpdf_static.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5fd98564066d4b0e0ac25ee5cf09fa02::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5fd98564066d4b0e0ac25ee5cf09fa02::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5fd98564066d4b0e0ac25ee5cf09fa02::$classMap;

        }, null, ClassLoader::class);
    }
}
