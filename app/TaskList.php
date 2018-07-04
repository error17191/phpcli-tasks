<?php

namespace App;

class TaskList
{
    protected $tasks = [];

    protected $path;

    public function __construct($filePath)
    {
        if (file_exists($filePath)) {
            $this->tasks = json_decode(file_get_contents($filePath));
        } else {
            file_put_contents($filePath, '[]');
            $this->tasks = [];
        }

        $this->path = $filePath;
    }

    public function add(string $task)
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
        return false !== file_put_contents($this->path, json_encode($this->tasks
                , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }

    public function clear()
    {
        $this->tasks = [];
        return $this->save();
    }
}