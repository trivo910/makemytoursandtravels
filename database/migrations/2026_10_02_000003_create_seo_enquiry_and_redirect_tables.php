<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_metadata', function (Blueprint $table) {
            $table->id();
            $table->string('seoable_type');
            $table->unsignedBigInteger('seoable_id');
            $table->string('title')->nullable();
            $table->string('description', 320)->nullable();
            $table->text('canonical_url')->nullable();
            $table->string('focus_keyword')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->text('og_image')->nullable();
            $table->string('twitter_card', 32)->default('summary_large_image');
            $table->boolean('robots_index')->default(true);
            $table->boolean('robots_follow')->default(true);
            $table->json('schema_json')->nullable();
            $table->timestamps();
            $table->unique(['seoable_type', 'seoable_id']);
        });

        Schema::create('contact_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('email')->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('subject');
            $table->text('message');
            $table->string('status', 24)->default('new')->index();
            $table->timestamps();
        });

        Schema::create('booking_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('email')->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('pickup_location');
            $table->string('destination');
            $table->date('travel_date')->index();
            $table->time('pickup_time')->nullable();
            $table->unsignedInteger('passenger_count');
            $table->string('vehicle_type', 32)->nullable();
            $table->foreignId('vehicle_id')->nullable()->constrained()->nullOnDelete();
            $table->text('message')->nullable();
            $table->string('status', 24)->default('new')->index();
            $table->timestamps();
        });

        Schema::create('redirects', function (Blueprint $table) {
            $table->id();
            $table->string('source_path')->unique();
            $table->text('destination_url');
            $table->unsignedSmallInteger('status_code')->default(301);
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('redirects');
        Schema::dropIfExists('booking_enquiries');
        Schema::dropIfExists('contact_enquiries');
        Schema::dropIfExists('seo_metadata');
    }
};
