<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->string('supplier');
            $table->date('alert_date');
            $table->unsignedInteger('primary_contact')->nullable();
            $table->string('reference')->unique()->nullable();
            $table->boolean('add_to_calendar')->default(false);
            $table->string('category')->nullable();
            $table->string('currency')->nullable();
            $table->string('contract_value')->nullable();
            $table->string('contract_period')->nullable();
            $table->date('start_date')->nullable();
            $table->string('notice_period')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('no_end_date')->default(false);
            $table->boolean('requires_special_privileges')->default(false);
            $table->unsignedInteger('created_by')->nullable();
            $table->text('visible_to')->nullable();
            $table->unsignedInteger('secondary_contact')->nullable();
            $table->string('file')->nullable();
            $table->text('notes')->nullable();
            $table->text('link')->nullable();
            $table->text('google_link')->nullable();
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
        Schema::dropIfExists('contracts');
    }
}
