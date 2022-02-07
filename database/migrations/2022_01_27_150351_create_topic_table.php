<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Topic;

class CreateTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Topic::TABLE, function (Blueprint $table) {
            $table->id();
            $table->uuid(Topic::UUID)->unique();
            $table->json(Topic::SOURCE)->nullable();
            $table->text(Topic::AUTHOR)->nullable();
            $table->text(Topic::TITLE);
            $table->text(Topic::DESCRIPTION);
            $table->text(Topic::URL)->nullable();
            $table->text(Topic::URL_TO_IMAGE)->nullable();
            $table->text(Topic::PUBLISHED_AT);
            $table->text(Topic::CONTENT)->nullable();
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
        Schema::dropIfExists(Topic::TABLE);
    }
}
