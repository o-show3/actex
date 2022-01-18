<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\MessageUser;
use App\Models\Message;
use App\Models\User;

class CreateMessageUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(MessageUser::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignId(MessageUser::USER_ID)->constrained(User::TABLE);
            $table->foreignId(MessageUser::TO_USER_ID)->constrained(User::TABLE);
            $table->foreignId(MessageUser::MESSAGE_ID)->constrained(MESSAGE::TABLE);
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
        Schema::dropIfExists(MessageUser::TABLE);
    }
}
