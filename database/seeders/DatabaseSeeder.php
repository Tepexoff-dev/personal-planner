<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        $user = User::factory()
            ->has(Project::factory(3))
            ->create();

        $projectIds = $user->projects()->pluck('id')->all();
        $projectIds[] = null;

        Task::factory(30)
            ->for($user)
            ->sequence(
                ...array_map(fn ($projectId) => ['project_id' => $projectId], $projectIds)
            )
            ->differentStatus()
            ->differentPriority()
            ->create();
    }
}
