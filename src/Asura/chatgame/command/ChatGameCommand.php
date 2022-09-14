<?php

namespace Asura\chatgame\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class ChatGameCommand extends Command{

    public function __construct(){
        parent::__construct("chatgame", "Enable or disable chatgame", "/chatgame [on-off]", []);
        $this->setPermission("chatgame.permission");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if (!isset($args[0])){
            $sender->sendMessage(TextFormat::RED . $this->getUsage());
            return;
        }
        if (strtolower($args[0]) === "on"){

        }
    }
}