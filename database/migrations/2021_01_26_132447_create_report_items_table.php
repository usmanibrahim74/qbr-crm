<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('report_id');
            $table->unsignedInteger('group_item_id');
            $table->unsignedInteger('group_id');
            $table->string('status')->nullable();
            $table->string('notes')->nullable();
            $table->string('solution')->nullable();
            $table->string('qtr')->nullable();
            $table->string('target_year')->nullable();
            $table->string('budget')->nullable();
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
        Schema::dropIfExists('report_items');
    }
}
