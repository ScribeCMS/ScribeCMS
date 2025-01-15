<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp('published_at')
                ->nullable();
            $table->softDeletes();
            $table->string('status', length: 20);
            $table->foreignIdFor(User::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('title', length: 255)
                ->nullable();
            $table->string('slug', length: 255)
                ->nullable()
                ->unique();
            $table->longText('body')
                ->nullable();
            $table->boolean('comments_on')
                ->nullable()
                ->default(env('COMMENTS_ON'));
            $table->integer('comment_count')
                ->default(0);
        });

        Schema::table( 'posts', function( Blueprint $table ) {
            $table->index( [ 'status', 'title' ] );
            $table->index( [ 'status', 'slug' ] );
        } );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
