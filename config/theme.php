<?php

return [

    /*
    |--------------------------------------------------------------------------
    | The currently active theme
    |--------------------------------------------------------------------------
    |
    | The currently acvtive theme, set by either an entry in the .env file,
    | or as an environmental variable on your server. If neither are
    | found, the default theme, buena-vista, will be used instead.
    |
    */
    'active' => env( 'THEME_ACTIVE', 'buena-vista' ),

    /*
    |--------------------------------------------------------------------------
    | The path to the currently active theme
    |--------------------------------------------------------------------------
    */
    'path' => resource_path( sprintf( '/views/themes/%s', env( 'THEME_ACTIVE' ) ) ),

    /*
    |--------------------------------------------------------------------------
    | The assets path for the currently active theme
    |--------------------------------------------------------------------------
    */
    'assets_path' => resource_path( sprintf( '/views/themes/%s/assets', env( 'THEME_ACTIVE' ) ) ),

    /*
    |--------------------------------------------------------------------------
    | The assets path for the currently active theme
    |--------------------------------------------------------------------------
    */
    'components_path' => resource_path( sprintf( '/views/themes/%s/components', env( 'THEME_ACTIVE' ) ) ),

    /*
    |--------------------------------------------------------------------------
    | Information about the currently active theme
    |--------------------------------------------------------------------------
    |
    | The JSON data from theme.json, which should be included with each
    | theme. See the default theme (buena-vista) for example data.
    |
    */
    'info' => json_decode(
        file_get_contents(
            resource_path(
                sprintf( '/views/themes/%s/theme.json', env( 'THEME_ACTIVE' ) )
            )
        ),
        true
    ),

];
