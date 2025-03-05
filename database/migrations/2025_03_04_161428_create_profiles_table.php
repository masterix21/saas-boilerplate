<?php

use App\Models\Enums\ProfileType;
use App\Models\Team;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Team::class)
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->boolean('is_supplier')->default(false);
            $table->boolean('is_customer')->default(false);

            $table->char('type', 3)->default(ProfileType::COMPANY);

            $table->string('name', 150)->nullable();
            $table->string('first_name', 60)->nullable();
            $table->string('last_name', 60)->nullable();

            $table->string('vat_no', 20)->nullable();
            $table->string('tax_code', 20)->nullable();

            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
