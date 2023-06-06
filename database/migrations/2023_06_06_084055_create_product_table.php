<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('product_id')->unsigned();
            $table->unsignedBigInteger('store_id');
            $table->string('name', 50);
            $table->integer('inventory_quantity')->default(0);
            $table->timestamp('inventory_updated_time')->default(DB::raw('current_timestamp() ON UPDATE current_timestamp()'));

            $table->foreign('store_id')->references('store_id')->on('store')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['store_id']);
        });

        Schema::dropIfExists('product');
    }
};
