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
        Schema::create('mhead_offices', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('images');
            $table->string('owner');
            $table->text('address');
            $table->string('city');
            $table->string('contact');
            $table->string('lead');
            $table->timestamps();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->softDeletes('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mhead_offices');
    }
};
