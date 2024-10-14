<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRecipientTypeToAnnouncementsTable extends Migration
{
    public function up()
    {
        Schema::table('announcements', function (Blueprint $table) {
            // Add the recipient_type column with default value 'everyone'
            $table->string('recipient_type')->default('everyone');
        });
    }

    public function down()
    {
        Schema::table('announcements', function (Blueprint $table) {
            // Drop the recipient_type column in case of rollback
            $table->dropColumn('recipient_type');
        });
    }
}
