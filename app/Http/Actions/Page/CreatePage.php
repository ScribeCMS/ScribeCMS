<?php
namespace App\Http\Actions\Page;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Page;
use App\Enums\PageStatus;

class CreatePage extends UpdatePage
{
    public function handle( $page, $request ): Page
    {
        $page = $this->createPageDraft( $page ); // to do: Error handling

        return $this->update( $page, $request );
    }

    protected function createPageDraft( Page $page ): Page
    {
        return $page->create( [
            'status'=> PageStatus::DRAFT->value,
            'user_id' => 1, // To do, make this the logged in user
        ] );
    }
}
