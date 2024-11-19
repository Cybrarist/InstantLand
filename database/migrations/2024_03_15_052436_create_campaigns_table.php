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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->timestamps();


            $table->string("name");

            $table->string("link" , 1000)->unique();
            $table->text("description")->nullable();
            $table->date("start_at")->nullable();
            $table->date("end_at")->nullable();

            $table->string("status")->default(\App\Enums\StatusEnum::Active->value);

            $table->foreignIdFor(\App\Models\User::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
