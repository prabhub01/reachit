<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_details', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id')->unsigned();
            $table->longText('about');
            $table->string('primary_phone', 10);
            $table->string('secondary_phone', 10)->nullable();
            $table->string('address', 50)->nullable();
            $table->string('logo', 50)->nullable();
            $table->integer('industry_type_id')->unsigned();
            
            
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
        Schema::dropIfExists('company_details');
    }
}