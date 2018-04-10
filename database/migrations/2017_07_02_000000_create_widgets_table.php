<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'widgets', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'title', 255 )->nullable();
            $table->string( 'subtitle', 255 )->nullable();
            $table->string( 'type', 40 );
            $table->string( 'sidebar', 40 );
            $table->integer( 'position' )->default( 0 );
            $table->longText( 'data' )->nullable();
            $table->string( 'css', 255 )->nullable();
            $table->tinyInteger( 'configured' )->default( 0 );
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'widgets' );
    }
}