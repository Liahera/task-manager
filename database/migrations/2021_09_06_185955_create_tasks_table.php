<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');;
            $table->BigInteger('user_id')->unsigned();
            $table->BigInteger('project_id')->unsigned();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('status', ['New', 'In progress', 'Done'])->default('New');
            $table->timestamps();
        });

        /*
            Delete tasks associated with this project ID
            */
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public
    function down()
    {
        Schema::dropIfExists('tasks');
    }
}
