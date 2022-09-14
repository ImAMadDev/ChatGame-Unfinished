<?php

namespace Asura\chatgame\task;

use Asura\chatgame\games\Game;
use pocketmine\scheduler\Task;
use pocketmine\Server;

class ChatGameRunTask extends Task{

    protected Game $game;

    public function __construct(Game $game){
        $this->game = $game;
    }

    /**
     * @return Game
     */
    public function getGame(): Game{
        return $this->game;
    }

    public function onRun(): void{
        var_dump($this->getGame()->getTime());
        if ($this->getGame()->getTime() <= 0){
            Server::getInstance()->broadcastMessage("Se ha desactivado el juego: " . $this->getGame()->getIdentifier());
            $this->getGame()->reset();
            $this->getGame()->setTask(null);
            $this->getGame()->setTime(60);
            $this->getHandler()?->cancel();
        } else {
            $this->getGame()->reduceTime(1);
        }
    }
}