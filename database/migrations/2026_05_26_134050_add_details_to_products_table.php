<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('rating', 3, 1)->nullable()->after('name');
            $table->text('main_ingredients')->nullable()->after('description');
            $table->text('how_to_use')->nullable()->after('main_ingredients');
            
            $table->dropColumn('image');
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['rating', 'main_ingredients', 'how_to_use', 'image_1', 'image_2', 'image_3']);
            $table->string('image')->nullable();
        });
    }
};
