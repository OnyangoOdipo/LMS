<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAnnouncementsTableRecipientType extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('announcements', function (Blueprint $table) {
            // Rename 'cohort' column to 'recipient_type'
            $table->renameColumn('cohort', 'recipient_type');
            
            // Change the type of the column to enum and set new options
            $table->enum('recipient_type', ['cohort_1', 'cohort_2', 'everyone'])->default('everyone')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('announcements', function (Blueprint $table) {
            // Revert changes: rename back and change type
            $table->enum('cohort', [1, 2])->default(1)->change();
            $table->renameColumn('recipient_type', 'cohort');
        });
    }
}
