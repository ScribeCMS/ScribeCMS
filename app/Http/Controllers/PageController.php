<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

use App\Models\Page;
use App\Http\Actions\Page\CreatePage;
use App\Http\Actions\Page\UpdatePage;

class PageController extends Controller
{
    public function index( Request $request )
    {
        $pages = Page::query()
            ->when( $request->has( 'trashed' ), function( $query ) {
                return $query->onlyTrashed();
            } )
            ->orderBy('Title', 'asc')
            ->with('user')
            ->paginate(10);

        return view(Route::currentRouteName(), ['pages' => $pages]);
    }

    public function create()
    {
        return view(Route::currentRouteName());
    }

    public function show( Page $page )
    {
        return to_route( 'admin.pages.edit', [ 'page' => $page ] );
    }

    public function edit( Page $page )
    {
        return view(Route::currentRouteName(), ['page' => $page]);
    }

    public function store( Page $page, CreatePage $create )
    {
        $page = $create->handle( $page, request() );

        return to_route('admin.pages.edit', ['page' => $page]);
    }

    public function update( Page $page, UpdatePage $update )
    {
        $page = $update->handle( $page, request() );

        return to_route('admin.pages.edit', ['page' => $page]);
    }

    public function trash( Page $page )
    {
        if ( $page->delete() ) {
            $page->update( [ 'slug' => null ] );
            return to_route( 'admin.pages.index' );
        }

        return back()->withErrors( ['message'=> 'Page could not be deleted'] );
    }

    public function restore( Page $page )
    {
        if( $page->restore() ) {
            return to_route( 'admin.pages.index' );
        }

        return back()->withErrors( [ 'message'=> 'Page could not be restored' ] );
    }

    public function destroy( Page $page )
    {
        if ( $page->forceDelete() ) {
            return to_route( 'admin.pages.index', [ 'trashed' => 1 ] );
        }

        return back()->withErrors( [ 'message'=> 'Page could not be permanently deleted' ] );
    }
}
