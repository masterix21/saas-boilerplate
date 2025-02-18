<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class, 'owner_id')
                ->constrained('users')->cascadeOnUpdate()->cascadeOnUpdate();

            $table->string('name');

            $table->string('vat_no')->nullable();
            $table->string('tax_code')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
