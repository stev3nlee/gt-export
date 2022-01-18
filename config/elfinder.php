<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Upload dir
    |--------------------------------------------------------------------------
    |
    | The dir where to store the images (relative from public)
    |
    */
    'dir' => ['files'],

    /*
    |--------------------------------------------------------------------------
    | Filesystem disks (Flysytem)
    |--------------------------------------------------------------------------
    |
    | Define an array of Filesystem disks, which use Flysystem.
    | You can set extra options, example:
    |
    | 'my-disk' => [
    |        'URL' => url('to/disk'),
    |        'alias' => 'Local storage',
    |    ]
    */
    'disks' => [
            'local',
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes group config
    |--------------------------------------------------------------------------
    |
    | The default group settings for the elFinder routes.
    |
    */

    'route' => [
        'prefix' => 'elfinder',
        'middleware' => null, //Set to null to disable middleware filter
    ],

    /*
    |--------------------------------------------------------------------------
    | Access filter
    |--------------------------------------------------------------------------
    |
    | Filter callback to check the files
    |
    */

    'access' => 'Barryvdh\Elfinder\Elfinder::checkAccess',

    /*
    |--------------------------------------------------------------------------
    | Roots
    |--------------------------------------------------------------------------
    |
    | By default, the roots file is LocalFileSystem, with the above public dir.
    | If you want custom options, you can set your own roots below.
    |
    */

    'roots' => array(
                array(
                'driver' => 'LocalFileSystem',
                'path' =>  '../public/storage/files/',
                'URL' => 'https://beta.gtexport.sg/'
                )
                ),

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    | These options are merged, together with 'roots' and passed to the Connector.
    | See https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options-2.1
    |
    */

    'options' => array('debug' => true,
        'bind' => array(
                'upload.presave' => array(
                    'Plugin.Watermark.onUpLoadPreSave'
                )
            ),
            // global configure (optional)
            'plugin' => array(
                'Watermark' => array(
                    'enable'         => true,       // For control by volume driver
                    'source'         => 'images/logo.png', // Path to Water mark image
                     'position' => 'RM',       // Position L(eft)/C(enter)/R(ight) and T(op)/M(edium)/B(ottom)
                    //'marginX' => 5,          // Margin horizontal pixel
                    //'marginY' => 5,          // Margin vertical pixel
                    'marginRight'    => 5,          // Margin right pixel
                    'marginBottom'   => 5,          // Margin bottom pixel
                    //'position'       => 'CB',       // Position L(eft)/C(enter)/R(ight) and T(op)/M(edium)/B(ottom)
                    'quality'        => 95,         // JPEG image save quality
                    'transparency'   => 70,         // Water mark image transparency ( other than PNG )
                    'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
                    'targetMinPixel' => 200,        // Target image minimum pixel size
                    'interlace'      => IMG_GIF|IMG_JPG, // Set interlacebit image formats ( bit-field )
                    'offDropWith'    => null        // To disable it if it is dropped with pressing the meta key
                                                    // Alt: 8, Ctrl: 4, Meta: 2, Shift: 1 - sum of each value
                                                    // In case of using any key, specify it as an array
                )
            ),
    ),
    
    /*
    |--------------------------------------------------------------------------
    | Root Options
    |--------------------------------------------------------------------------
    |
    | These options are merged, together with every root by default.
    | See https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options-2.1#root-options
    |
    */
    'root_options' => array(

    ),

);
