<?php

require_once 'vendor/autoload.php';

use App\TaskList;

$taskList = new TaskList('./tasks.json');
if (count($argv) == 1) {
    echo "You must specify a command.\nAvailable Commands:\n";
    echo "add: adds a new task\n";
    echo "all: show all tasks\n";
    echo "clear: clears all tasks\n";
    exit;
}
$command = $argv[1];

switch ($command) {
    case 'add' :
        if (empty($argv[2])) {
            echo "You must enter the task you want to add\n";
            exit;
        }
        $taskList->add($argv[2]);
        echo $taskList->save() ? "Saved successfully\n" : "Unknown error\n";

        break;
    case 'all' :
        if($taskList->isEmpty()){
            echo "No tasks yet\n";
            exit();
        }
        echo "Your tasks:\n";
        echo implode("\n", $taskList->all());
        break;
    case 'clear':
        echo $taskList->clear() ? "Cleared successfully\n" : "Unknown error\n";
        break;
    default:
        echo "Invalid Command\n";

}


