<?php

namespace Tests\Feature;

use App\Task;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


/**
 * Class ViewUsersTasks
 * @package Tests\Feature
 */
class ViewUsersTasks extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function an_user_can_see_is_own_tasks()
    {
        // Preparar
        $user=factory(User::class)->create();
        $tasks=factory(Task::class,10)->create();
        $user->tasks()->saveMany($tasks);

        // Executar
//        $this->withoutExceptionHandling(); //Ensenyar errors

        $response = $this->get('user/'. $user->id .'/tasks');
//        $response->dump(); Ensenyar errors
        $response->assertSuccessful();
        $response->assertViewIs('user_tasks');
        $response->assertViewHas('tasks', $user->tasks);
        $response->assertViewHas('user', $user);

        $response->assertSeeText($user->name. ' Tasks:');

        foreach ($tasks as $task) {
            $response->assertSeeText($task->name);
        }

        //Comprobar

    }
}
