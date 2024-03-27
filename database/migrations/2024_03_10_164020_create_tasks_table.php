<?php

use App\Models\EntityStatus;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string("title")->nullable(false);
            $table->tinyText("description");
            $table->enum("status", [
                EntityStatus::ACTIVE->value,
                EntityStatus::PAUSE->value,
                EntityStatus::FINISH->value
            ])->default(EntityStatus::ACTIVE);
            $table->foreignIdFor(Project::class)->references("id")->on("projects")->cascadeOnDelete();
            $table->foreignIdFor(User::class, "creator_id")->references("id")->on("users")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
