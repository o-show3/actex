<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\Models\Category::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(Category::NAME, Category::MAX_LENGTH[Category::NAME]);
            $table->string(Category::DESCRIPTION, Category::MAX_LENGTH[Category::DESCRIPTION]);
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
        Schema::dropIfExists(\App\Models\Category::TABLE);
    }
}
