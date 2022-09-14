<?php

namespace Asura\chatgame\task;

use Asura\chatgame\games\GameFactory;
use pocketmine\scheduler\Task;

class ChatGameEnableTask extends Task{

    private int $time = 120;

    public function onRun(): void{
        if ($this->time-- <= 0){
            GameFactory::getInstance()->activateNewGame();
            $this->time = 120;
        }
    }
}