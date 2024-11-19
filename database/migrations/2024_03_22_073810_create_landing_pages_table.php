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
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string("name");
            $table->text("link")->unique();
            $table->string("status")->default(\App\Enums\StatusEnum::Active->value);

            $table->text("description")->nullable();

            $table->longText("header")->nullable();
            $table->longText("gjs_data")->nullable();
            $table->longText("footer")->nullable();

            $table->text("css_files")->nullable();
            $table->text("js_files")->nullable();

            $table->unsignedTinyInteger('AB_testing')->default(0)->nullable();

            $table->foreignIdFor(\App\Models\Campaign::class)->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(\App\Models\User::class);

            $table->unique(["link" , "campaign_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_pages');
    }
};
