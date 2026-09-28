<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('plan', 16)->default('free')->after('is_admin');
            $table->string('custom_domain')->nullable()->after('plan');
            $table->boolean('remove_branding')->default(false)->after('custom_domain');
            $table->string('organization_name')->nullable()->after('remove_branding');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['plan', 'custom_domain', 'remove_branding', 'organization_name']);
        });
    }
};
