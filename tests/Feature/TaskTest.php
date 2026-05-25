<?php

use App\Models\User;
use App\Models\Task;

test('authenticated user can view tasks page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/tasks');

    $response->assertStatus(200);
});

test('guest cannot access tasks page', function () {
    $response = $this->get('/tasks');

    $response->assertRedirect('/login');
});

test('authenticated user can create a task', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/tasks', [
        'title' => 'Test Task',
        'description' => 'Test Description',
        'status' => 'pending',
        'due_date' => '2027-01-01',
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('tasks', ['title' => 'Test Task']);
});

test('authenticated user can delete a task', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->delete("/tasks/{$task->id}");

    $response->assertRedirect();
    $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
});