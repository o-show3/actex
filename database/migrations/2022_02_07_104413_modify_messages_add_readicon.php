<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Message;

class ModifyMessagesAddReadicon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(Message::TABLE, function (Blueprint $table) {
            $table->integer(Message::READ_ICON)->after(Message::MESSAGE)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(Message::TABLE, function (Blueprint $table) {
            $table->dropColumn(Message::READ_ICON);
        });
    }
}
