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
            $table->string('type');
            $table->float('amount', 20, 8);
            $table->float('current_price', 20, 12);
            $table->float('value', 20, 12);
            $table->boolean('closed')->default(0);
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
