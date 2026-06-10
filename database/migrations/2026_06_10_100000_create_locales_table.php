<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('locales', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('country_code', 2);
            $table->string('language_code', 5);
            $table->boolean('is_default_for_country')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['country_code', 'language_code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locales');
    }
};
