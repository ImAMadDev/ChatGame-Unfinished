<?php

namespace Asura\chatgame;

use Asura\chatgame\command\ChatGameCommand;
use Asura\chatgame\games\GameFactory;
use Asura\chatgame\listener\PlayerChatListener;
use Asura\chatgame\utils\Settings;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class ChatGame extends PluginBase{
    use SingletonTrait;

    public function onLoad(): void{
        self::$instance = $this;
    }

    protected function onEnable(): void{
        Settings::init();
        GameFactory::getInstance()->init();
        $this->getServer()->getCommandMap()->register("chatgame", new ChatGameCommand());
        $this->getServer()->getPluginManager()->registerEvents(new PlayerChatListener(), $this);
    }

}