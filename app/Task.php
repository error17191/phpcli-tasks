<?php

namespace App;


use Carbon\Carbon;

class Task
{
    public $title;
    public $created_at;

    public function __construct(string $title)
    {
        $this->title = $title;
        $this->created_at = Carbon::now();
    }


}