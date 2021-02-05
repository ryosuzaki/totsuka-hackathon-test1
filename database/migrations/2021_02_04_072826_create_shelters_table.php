<?php
#shelter

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSheltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shelters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('code', 50)->unique();
            $table->string('name', 100);
            #$table->geometry('location');
            $table->integer('degree_of_congestion')->nullable($value = true);
            $table->text('info')->nullable($value = true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shelters');
    }
}
