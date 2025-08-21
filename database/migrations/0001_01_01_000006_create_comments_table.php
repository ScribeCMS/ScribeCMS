<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create( 'comments', function ( Blueprint $table ) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignIdFor( User::class )
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->foreignIdFor( Post::class )
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor( Comment::class, 'parent_id' )
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->string( 'status', 20 ); //published, pending, spam
            $table->ipAddress( 'ip' )
                ->nullable();
            $table->string( 'ua', 255 )
                ->nullable();
            $table->string( 'name', 50 );
            $table->string( 'email', 50 );
            $table->string( 'url', 50 )
                ->nullable();
            $table->string( 'avatar', 50 )
                ->nullable();
            $table->longText( 'body' );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
