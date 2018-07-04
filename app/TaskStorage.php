<?php

namespace App;


class TaskStorage
{
    protected $json;

    protected $path;

    public function __construct(string $filePath)
    {
        if (file_exists($filePath)) {
            $this->json = file_get_contents($filePath);
        } else {
            file_put_contents($filePath, "[]");
            $this->json = "[]";
        }
        $this->path = $filePath;
    }

    public function store(TaskList $taskList)
    {
        $this->json = $this->encodeJson($taskList->all());
        return false !== file_put_contents($this->path, $this->json);
    }

    public function fetchTasks()
    {
        return $this->decodeJson($this->json);
    }

    protected function encodeJson($data)
    {
        return json_encode($data
            , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    protected function decodeJson($json)
    {
        return json_decode($json);
    }
}