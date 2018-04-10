<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSidebarsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'sidebars', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'name', 40 )->unique();
            $table->string( 'title', 255 )->nullable();
            $table->string( 'subtitle', 255 )->nullable();
            $table->string( 'footer', 255 )->nullable();
            $table->string( 'before', 255 )->nullable();
            $table->string( 'after', 255 )->nullable();
            $table->string( 'columns', 255 )->nullable();
            $table->string( 'label', 40 )->nullable();
            $table->tinyInteger( 'collapsed' )->default( 0 );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'sidebars' );
    }
}