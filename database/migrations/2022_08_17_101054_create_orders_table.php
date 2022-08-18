<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('watcher_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->json('binance_data')->nullable();
            $table->string('side');
            $table->float('amount', 20, 8);
            $table->float('price', 20, 12);
            $table->float('value', 20, 12);
            $table->string('status')->nullable();
            $table->boolean('closed')->default(0);
            $table->timestamp('closed_at')->nullable();
           // $table->float('profit', 20, 8)->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
