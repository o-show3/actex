<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Pair;

class CreatePairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Pair::TABLE, function (Blueprint $table) {
            $table->id();
            // リレーション
            $table->foreignId(Pair::USER_ID)->constrained('users');
            $table->foreignId(Pair::USER_ID_PAIRING)->constrained('users');
            $table->boolean(Pair::INVALID)
                  ->default(false);
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
        Schema::dropIfExists(Pair::TABLE);
    }
}
