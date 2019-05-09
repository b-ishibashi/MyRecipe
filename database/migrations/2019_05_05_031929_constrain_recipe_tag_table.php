<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConstrainRecipeTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipe_tag', function (Blueprint $table) {
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags');
            $table->foreign('recipe_id')
                ->references('id')
                ->on('recipes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipe_tag', function (Blueprint $table) {
            $table->dropForeign('tag_id');
            $table->dropForeign('recipe_id');
        });
    }
}
