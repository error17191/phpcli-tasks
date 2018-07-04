<?php


class TaskListTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function last_returns_null_when_no_tasks()
    {
        $taskList = new \App\TaskList(__DIR__ . '/../temp/' . uniqid() . '.json');

        $this->assertEquals(null, $taskList->last());
    }

    /** @test */
    public function all_method_returns_array()
    {
        $taskList = new \App\TaskList(__DIR__ . '/../temp/' . uniqid() . '.json');
        $taskList->add('SomeTask');

        $this->assertTrue(is_array($taskList->all()));
    }

    /** @test */
    public function all_method_returns_empty_array_if_no_tasks()
    {
        $taskList = new \App\TaskList(__DIR__ . '/../temp/' . uniqid() . '.json');

        $this->assertTrue(is_array($taskList->all()));
        $this->assertCount(0, $taskList->all());
    }

    /** @test */
    public function it_can_add_a_task()
    {
        $taskList = new \App\TaskList(__DIR__ . '/../temp/' . uniqid() . '.json');
        $taskList->add('Bla bla bla');
        $tasks = $taskList->all();
        $task = $taskList->last();

        $this->assertCount(1, $tasks);
        $this->assertEquals('Bla bla bla', $task);
    }

    /** @test */
    public function it_can_return_count_of_tasks()
    {
        $taskList = new \App\TaskList(__DIR__ . '/../temp/' . uniqid() . '.json');

        $this->assertEquals(0, $taskList->count());
    }

    /** @test */

    public function it_can_check_if_the_list_is_empty()
    {
        $taskList = new \App\TaskList(__DIR__ . '/../temp/' . uniqid() . '.json');

        $this->assertTrue($taskList->isEmpty());
    }

    /** @test */

    public function it_can_save_all_tasks()
    {
        $path = __DIR__ . '/../temp/' . uniqid() . '.json';
        $taskList = new \App\TaskList($path);

        $taskList->add('Task One');
        $taskList->add('Task Two');

        $taskList->save();

        $newTaskList = new \App\TaskList($path);

        $this->assertCount(2, $newTaskList->all());
        $this->assertEquals('Task One', $newTaskList->all()[0]);
        $this->assertEquals('Task Two', $newTaskList->all()[1]);
    }

    /** @test */

    public function it_can_clear_all_tasks()
    {
        $path = __DIR__ . '/../temp/' . uniqid() . '.json';
        $taskList = new \App\TaskList($path);
        $taskList->add('one');
        $taskList->add('two');

        $taskList->clear();

        $this->assertCount(0, $taskList->all());

        $taskList = new \App\TaskList($path);
        $this->assertCount(0, $taskList->all());
    }

    /** @test */
    public function it_can_add_after_it_saves()
    {
        $path = __DIR__ . '/../temp/' . uniqid() . '.json';
        $taskList = new \App\TaskList($path);
        $taskList->add('One');
        $taskList->save();
        $taskList->add('Two');

        $this->assertCount(2, $taskList->all());
        $this->assertEquals('One', $taskList->all()[0]);
        $this->assertEquals('Two', $taskList->all()[1]);
    }

    /** @test */
    public function it_can_add_after_it_clears()
    {
        $path = __DIR__ . '/../temp/' . uniqid() . '.json';
        $taskList = new \App\TaskList($path);
        $taskList->add('One');
        $taskList->clear();
        $taskList->add('Two');

        $this->assertCount(1, $taskList->all());
        $this->assertEquals('Two', $taskList->all()[0]);
    }

    /** @test */
    public function it_can_save_after_it_clears()
    {
        $path = __DIR__ . '/../temp/' . uniqid() . '.json';
        $taskList = new \App\TaskList($path);
        $taskList->add('One');
        $taskList->clear();
        $taskList->add('Two');
        $taskList->save();

        $taskList = new \App\TaskList($path);
        $this->assertCount(1, $taskList->all());
        $this->assertEquals('Two', $taskList->all()[0]);
    }
}