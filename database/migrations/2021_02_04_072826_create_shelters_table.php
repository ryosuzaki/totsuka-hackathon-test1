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
            $table->increments('id');
            $table->unsignedInteger('updated_by');
            $table->string('name')->index();
            $table->text('info')->nullable($value = true);
            $table->tinyInteger('degree_of_congestion')->nullable($value = true);
            $table->text('detail_of_congestion')->nullable($value = true);
            $table->string('staff_password');
            $table->string('user_password');
            $table->timestamps();
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