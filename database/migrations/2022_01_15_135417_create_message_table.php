<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Message;
use App\Models\User;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Message::TABLE, function (Blueprint $table) {
            $table->id();
            $table->tinyInteger(Message::TYPE)->default(Message::TYPE_TEXT);
            $table->text(Message::MESSAGE);
            $table->foreignId(Message::FILE_ID)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Message::TABLE);
    }
}
