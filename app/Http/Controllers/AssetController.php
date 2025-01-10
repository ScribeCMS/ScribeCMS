<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

class AssetController extends Controller
{
    protected array $extMap;

    public function __construct()
    {
        $this->extMap = [
            'css' => 'text/css',
            'js' => 'text/javascript',
            'jpg' => '',
            'jpeg' => '',
            'png' => '',
            'gif' => '',
            'webp' => '',
            'svg' => '',
        ];
    }
    public function file( string $file )
    {
        $filePath = resource_path( sprintf( '/views/themes/%s/assets/%s', config( 'theme.active' ), $file ) );

        if ( ! file_exists( $filePath ) ) {
            return response()->view( 'theme::404', [], 404 );
        }

        $extension = pathinfo( $filePath, PATHINFO_EXTENSION );

        $headers = $this->extMap[ $extension ] ? [ 'Content-Type' => $this->extMap[ $extension ] ] : [];

        return response()->file( $filePath, $headers );
    }
}
