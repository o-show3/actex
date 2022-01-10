<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Pair;

class AddStatusForPairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(Pair::TABLE, function (Blueprint $table) {
            $table->tinyInteger(Pair::STATUS)->after(Pair::USER_ID_PAIRING)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(Pair::TABLE, function (Blueprint $table) {
            $table->dropColumn(Pair::STATUS);
        });
    }
}
