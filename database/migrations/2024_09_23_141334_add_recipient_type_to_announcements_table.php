<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRecipientTypeToAnnouncementsTable extends Migration
{
    public function up()
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->enum('recipient_type', ['cohort_1', 'cohort_2', 'everyone'])->default('everyone');
        });
    }

    public function down()
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropColumn('recipient_type');
        });
    }
}
