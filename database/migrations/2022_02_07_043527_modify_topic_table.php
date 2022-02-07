<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Topic;

class ModifyTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(Topic::TABLE, function (Blueprint $table) {
            $table->integer(Topic::COUNTER)->after(Topic::PUBLISHED_AT)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(Topic::TABLE, function (Blueprint $table) {
            $table->dropColumn(Topic::COUNTER);
        });
    }
}
