<?php

namespace Asura\chatgame\listener;

use Asura\chatgame\games\GameFactory;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\Server;

class PlayerChatListener implements Listener{

    public function handleChat(PlayerChatEvent $event): void{
        $player = $event->getPlayer();
        $args = explode(" ", $event->getMessage());
        foreach (GameFactory::getInstance()->getGames() as $game) {
            if ($game->isActivated()){
                if($game->checkAnswer($args[0])){
                    Server::getInstance()->broadcastMessage($player->getName() . " ha ganado el evento de: " . $game->getIdentifier());
                    $game->reset();
                    var_dump("acerto");
                }
            }
        }
    }

}