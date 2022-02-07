<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TopicUser;
use App\Models\Topic;
use App\Models\User;

class CreateTopicUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(TopicUser::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignId(TopicUser::USER_ID)->constrained(User::TABLE);
            $table->foreignId(TopicUser::TOPIC_ID)->constrained(Topic::TABLE);
            $table->tinyInteger(TopicUser::STATUS);
            $table->timestamps();
            $table->softDeletes();

            $table->unique([TopicUser::USER_ID, TopicUser::TOPIC_ID]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(TopicUser::TABLE);
    }
}
