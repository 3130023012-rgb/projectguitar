<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('custom_orders', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_code')->unique(); // e.g. LBG-20260316-XXXX
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_country');
            $table->string('customer_phone')->nullable();
            $table->enum('order_type', ['custom_bass', 'custom_guitar']);
            $table->json('requirements')->nullable(); // desired_wood, string_count, scale_length, special_requests
            $table->decimal('budget', 12, 2)->nullable();
            $table->string('timeline')->nullable(); // e.g. "3-4 months"
            $table->enum('current_step', ['consultation', 'design', 'build', 'quality_check', 'shipping', 'completed'])->default('consultation');
            $table->text('notes')->nullable(); // admin internal notes
            $table->timestamps();
            $table->timestamp('completed_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('custom_orders');
    }
};
