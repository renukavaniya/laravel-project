<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
			$table->string('firstname');
			$table->string('lastname');
			$table->string('email');
			$table->integer('is_admin')->default(0);
			$table->string('password');
			$table->string('dob');
			$table->string('mobile');
			$table->string('gender');
			$table->string('address');
			$table->string('state');
			$table->string('city');
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
        Schema::dropIfExists('user');
    }
}
