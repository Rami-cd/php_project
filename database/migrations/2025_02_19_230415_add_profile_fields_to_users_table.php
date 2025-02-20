<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('first_name')->nullable();
        $table->string('last_name')->nullable();
        $table->string('headline')->nullable();
        $table->string('language')->nullable();
        $table->string('portfolio_url')->nullable();
        $table->string('linkedin_url')->nullable();
        $table->string('twitter_url')->nullable();
        $table->string('facebook_url')->nullable();
        $table->string('youtube_url')->nullable();
        $table->string('image_url')->nullable();
        $table->boolean('course_recs')->default(true);
        $table->boolean('offers_promotions')->default(true);
        $table->boolean('email_notification')->default(true);
        $table->boolean('instructor_notification')->default(true);
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn([
            'first_name', 'last_name', 'headline', 'language', 'portfolio_url',
            'linkedin_url', 'twitter_url', 'facebook_url', 'youtube_url', 'image_url',
            'course_recs', 'offers_promotions', 'email_notification', 'instructor_notification',
        ]);
    });
}

};
