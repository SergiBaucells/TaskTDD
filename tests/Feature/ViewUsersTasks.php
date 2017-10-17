<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
        $tasks=factory(Task::class,5)->create();
        $user->tasks()->saveMany($tasks);
        
        // Executar
        $response = $this->get('user/'. $user->id .'/tasks');

        $response->assertSuccessful();
        $response->assertViewIs('user_tasks');
        $response->assertViewHas('tasks',$user->tasks);

        $response->assertSeeText($user->name. 'Tasks: ');

        foreach ($tasks as $task) {
            $response->assertSeeText($tasks->name);
        }

        //Comprobar

    }
}
