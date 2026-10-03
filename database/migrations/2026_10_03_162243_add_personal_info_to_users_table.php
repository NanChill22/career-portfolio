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
        Schema::table('users', function (Blueprint $table) {
            $table->string('headline')->nullable()->after('email');
            $table->string('phone')->nullable()->after('headline');
            $table->string('city')->nullable()->after('phone');
            $table->text('address')->nullable()->after('city');
            $table->date('birth_date')->nullable()->after('address');
            $table->string('gender')->nullable()->after('birth_date');
            $table->text('bio')->nullable()->after('gender');
            $table->string('avatar')->nullable()->after('bio');
            $table->string('linkedin_url')->nullable()->after('avatar');
            $table->string('github_url')->nullable()->after('linkedin_url');
            $table->string('portfolio_url')->nullable()->after('github_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'headline',
                'phone',
                'city',
                'address',
                'birth_date',
                'gender',
                'bio',
                'avatar',
                'linkedin_url',
                'github_url',
                'portfolio_url',
            ]);
        });
    }
};
