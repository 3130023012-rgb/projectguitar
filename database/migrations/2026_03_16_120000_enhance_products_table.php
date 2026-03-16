<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop old columns that are being restructured
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->dropColumn('is_new');

            // Add new columns
            $table->enum('product_type', ['bass', 'guitar'])->default('guitar')->after('slug');
            $table->json('gallery_images')->nullable()->after('image');
            $table->enum('status', ['available', 'sold', 'custom_order'])->default('available')->change();
            $table->decimal('price', 12, 2)->change();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['product_type', 'gallery_images']);
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
            $table->boolean('is_new')->default(false);
            $table->enum('status', ['active', 'sale'])->default('active')->change();
        });
    }
};
