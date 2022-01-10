<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Administrator;
class CreateAdministratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Administrator::TABLE, function (Blueprint $table) {
            $table->id();
            // リレーション
            $table->foreignId(Administrator::USER_ID)->constrained('users')->unique();
            $table->tinyInteger(Administrator::ROLE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Administrator::TABLE);
    }
}
