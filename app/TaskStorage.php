<?php

namespace App;


class TaskStorage
{
    protected $encoded;

    protected $path;

    public function __construct(string $filePath)
    {
        if (file_exists($filePath)) {
            $this->encoded = file_get_contents($filePath);
        } else {
            $this->encoded = serialize([]);
            file_put_contents($filePath, $this->encoded);
        }
        $this->path = $filePath;
    }

    public function store(TaskList $taskList)
    {
        $this->encoded = $this->encode($taskList->all());
        return false !== file_put_contents($this->path, $this->encoded);
    }

    public function fetchTasks()
    {
        return $this->decode($this->encoded);
    }

    protected function encode($data)
    {
        return serialize($data);
    }

    protected function decode($encoded)
    {
        return unserialize($encoded);
    }
}