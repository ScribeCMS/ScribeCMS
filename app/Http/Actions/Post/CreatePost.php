<?php
namespace App\Http\Actions\Post;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Post;
use App\Enums\PageStatus;

class CreatePost extends UpdatePost
{
    public function handle( $post, $request ): Post
    {
        $post = $this->createPostDraft( $post ); // to do: Error handling

        return $this->update( $post, $request );
    }

    protected function createPostDraft( Post $post ): Post
    {
        return $post->create( [
            'status'=> PageStatus::DRAFT,
            'user_id' => 1, // To do, make this the logged in user
        ] );
    }
}
