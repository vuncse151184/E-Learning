<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(100);
            $table->string('name',20)->nullable();
            $table->string('email',100)->unique();
            $table->string('phone',20);
            $table->text('profile')->nullable();
            $table->date('birthday')->nullable();
            $table->tinyInteger('gender')->comment("0: female, 1: male");
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',100);
            $table->string('image',200)->nullable();
            $table->integer('is_active')->default(1)->comment("0: off, 1: enable");
            $table->rememberToken();
            $table->timestamp('last_login')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
