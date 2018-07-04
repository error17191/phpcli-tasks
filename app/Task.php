<?php

namespace App;


class Task
{
    public $title;
    public $created_at;

    public function __construct(string $title)
    {
        $this->title = $title;

    }


}