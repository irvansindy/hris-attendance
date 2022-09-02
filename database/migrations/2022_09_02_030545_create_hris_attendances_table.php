<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrisAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hris_attendances', function (Blueprint $table) {
            $table->id();
            $table->string('attenddata');
            $table->string('machine_code');
            $table->string('attendanceid');
            $table->dateTime('attend_date');
            $table->integer('hour');
            $table->integer('minute');
            $table->integer('second');
            $table->integer('day');
            $table->integer('month');
            $table->integer('year');
            $table->string('status');
            $table->string('machineno');
            $table->string('uploadstatus');
            $table->string('created_by');
            $table->dateTime('created_date');
            $table->string('modified_by');
            $table->string('modified_date');
            $table->integer('company_id');
            $table->string('remark');
            $table->string('photo');
            $table->string('geolocation');
            $table->integer('att_on');
            $table->softDeletes();
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
        Schema::dropIfExists('hris_attendances');
    }
}
