<?php

namespace App;

class TaskList
{
    protected $tasks = [];

    protected $storage;

    public function __construct(TaskStorage $storage)
    {
        $this->storage = $storage;
        $this->tasks = $this->storage->fetchTasks();
    }

    public function add(Task $task)
    {
        $this->tasks[] = $task;
    }

    public function all()
    {
        return $this->tasks;
    }

    public function last()
    {
        if (!$this->isEmpty()) {
            return $this->tasks[count($this->tasks) - 1];
        }
    }

    public function count()
    {
        return count($this->tasks);
    }

    public function isEmpty()
    {
        return $this->count() === 0;
    }

    public function save()
    {
        return $this->storage->store($this);
    }

    public function clear()
    {
        $this->tasks = [];
        return $this->save();
    }
}