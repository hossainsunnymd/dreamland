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
        Schema::create('logos', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->string('site_favicon')->nullable();
            $table->string('site_logo')->nullable();
            $table->string('fb_logo')->nullable();
            $table->longText('fb_link')->nullable();
            $table->string('twitter_logo')->nullable();
            $table->longText('twitter_link')->nullable();
            $table->string('instagram_logo')->nullable();
            $table->longText('instagram_link')->nullable();
            $table->string('linkedin_logo')->nullable();
            $table->longText('linkedin_link')->nullable();
            $table->string('youtube_logo')->nullable();
            $table->longText('youtube_link')->nullable();
            $table->string('about_banner_image')->nullable();
            $table->string('about_hero_image')->nullable();
            $table->longText('about_content')->nullable();
            $table->longText('booking_content')->nullable();
            $table->string('login_banner_image')->nullable();
            $table->string('register_banner_image')->nullable();
            $table->longText('site_address')->nullable();
            $table->string('site_email')->nullable();
            $table->string('site_phone')->nullable();
            $table->string('site_fax')->nullable();
            $table->string('service_banner_image')->nullable();
            $table->string('contact_banner_image')->nullable();
            $table->string('booking_banner_image')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logos');
    }
};
