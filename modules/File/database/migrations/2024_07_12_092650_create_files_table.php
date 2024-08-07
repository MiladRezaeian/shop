<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->primary('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('type',5);
            $table->string('path');
            $table->boolean('is_public')->default(false);
            $table->boolean('verified')->default(false);
            $table->Integer('size')->default(0);
            $table->string('mime_type');
            $table->morphs('fileable');
            $table->foreignId('user_id')->constrained();

            $table->softDeletes();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};