<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_histories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->integer('related_id')->nullable();
            $table->text('description')->nullable();
            $table->string('subject_type', 255)->nullable()->index();
            $table->integer('subject_id')->nullable()->index();
            $table->enum('type', ['sub_total', 'tax', 'discount'])->default('sub_total');
            $table->decimal('value', 15,2)->default(0);
            $table->decimal('sub_total', 15,2)->default(0);
            $table->foreignIdFor(Order::class);

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
        Schema::dropIfExists('order_histories');
    }
};
