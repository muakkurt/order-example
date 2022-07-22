<?php

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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true)->index();
            $table->string('name', 255)->index();
            $table->string('discount_class', 255)->index();
            $table->integer('priority')->index();
            $table->integer('relation_id')->nullable()->index();
            $table->integer('decision_limit')->index();
            $table->enum('type', ['percent', 'fixed', 'free'])->default('fixed')->index();
            $table->decimal('value', 15,2)->default(0)->index();
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
        Schema::dropIfExists('discounts');
    }
};
