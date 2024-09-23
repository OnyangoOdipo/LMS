<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTimeToDatetimeInQuizzesTable extends Migration
{
    public function up()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            // Change start_time and end_time from time to datetime
            $table->datetime('start_time')->change();
            $table->datetime('end_time')->change();
        });
    }

    public function down()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            // Revert back to time in case of rollback
            $table->time('start_time')->change();
            $table->time('end_time')->change();
        });
    }
}
