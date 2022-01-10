<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\CategoryUser;
use App\Models\User;
use App\Models\Category;

class CreateCategoryUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(CategoryUser::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignId(CategoryUser::USER_ID)->constrained(User::TABLE);
            $table->foreignId(CategoryUser::CATEGORY_ID)->constrained(Category::TABLE);
            $table->timestamps();
            $table->softDeletes();

            $table->unique([CategoryUser::USER_ID, CategoryUser::CATEGORY_ID]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(CategoryUser::TABLE);
    }
}
