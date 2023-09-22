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
        Schema::create('homestays', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('owner');
            $table->string('address');

            $table->double('rating');
            $table->integer('like');
            $table->integer('price');
            $table->integer('guest');
            $table->integer('bedroom');
            $table->integer('bed');
            $table->integer('bath');

            $table->boolean('has_wifi');
            $table->boolean('has_parking');
            $table->boolean('has_restaurant');
            $table->boolean('has_ac');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE homestays ADD FULLTEXT (name,location,address)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homestays');
    }
};
