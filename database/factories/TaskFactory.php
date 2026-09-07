<?php

namespace Database\Factories;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'project_id' => fn (array $attributes) => Project::factory()
                ->create(['user_id' => $attributes['user_id']])->getKey(),
            'title' => fake()->name(),
            'description' => fake()->text(),
            'priority' => fake()->randomElement(TaskPriority::cases()),
            'status' => fn () => fake()->randomElement(TaskStatus::cases()),
            'scheduled_at' => fake()->dateTimeBetween('now', '+1 year'),
            'due_at' => fn (array $attributes) => fake()->dateTimeBetween($attributes['scheduled_at'], '+1 year'),
            'completed_at' => fn (array $attributes) => match ($attributes['status']) {
                TaskStatus::Completed => fake()->dateTimeBetween('-1 year'),
                default => null
            },
            'created_at' => fn (array $attributes) => $attributes['completed_at']
                ? fake()->dateTimeBetween('-1 year', $attributes['completed_at'])
                : fake()->dateTimeBetween('-1 year'),
            'updated_at' => fn (array $attributes) => fake()->dateTimeBetween($attributes['completed_at']
                ?? $attributes['created_at']),
        ];
    }

    public function differentStatus(): static
    {
        return $this->sequence(
            ...array_map(
                fn (TaskStatus $status) => ['status' => $status],
                TaskStatus::cases()
            )
        );
    }

    public function differentPriority(): static
    {
        return $this->sequence(
            ...array_map(
                fn (TaskPriority $priority) => ['priority' => $priority],
                TaskPriority::cases()
            )
        );
    }
}
