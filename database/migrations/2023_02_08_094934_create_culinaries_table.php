<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('culinaries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('description');
            $table->double('rating');
            $table->integer('price');
            $table->string('photo');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE culinaries ADD FULLTEXT (name,description)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('culinaries');
    }
};
