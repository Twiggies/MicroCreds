<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credentials', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->text('institute_name');
            $table->string('institute_logo')->nullable();
            $table->text('certificate_name');
            $table->string('educator_signature')->nullable();
            $table->text('educator_title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credentials');
    }
}
