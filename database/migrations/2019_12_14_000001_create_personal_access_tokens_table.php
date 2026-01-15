<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * =================================================================================================
 *  CreatePersonalAccessTokensTable (The "Security Badges" Table)
 * =================================================================================================
 * 
 *  ANALOGY:
 *  This table stores the "API Keys" or "Security Badges" for your users.
 *  When a user logs in via an API (like a mobile app), they get a token.
 *  This table tracks who owns which token and what that token allows them to do.
 */
class CreatePersonalAccessTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();

            // 'morphs': A fancy Laravel shortcut. It creates two columns:
            // 1. tokenable_id (Who owns this? e.g., User ID 1)
            // 2. tokenable_type (What kind of thing owns this? e.g., "App\Models\User")
            // This allows tokens to be given to Users, Admins, or anything else in the future.
            $table->morphs('tokenable');

            $table->string('name'); // e.g., "My iPhone Token"
            $table->string('token', 64)->unique(); // The actual secret key (hashed).
            $table->text('abilities')->nullable(); // What can this token do? (e.g., "read-only")
            $table->timestamp('last_used_at')->nullable(); // When was it last used?
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
        Schema::dropIfExists('personal_access_tokens');
    }
}
