<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('receipts', function (Blueprint $table) {
            $table->string('id');
            $table->primary('id');
            $table->string('shopName');
            $table->string('name');
            $table->string('phoneNumber');
            $table->string('amount');
            $table->string('timestamp')->default(Time());
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
        Schema::dropIfExists('receipts');
    }
}
