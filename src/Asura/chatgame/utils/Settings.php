<?php

namespace Asura\chatgame\utils;

use Asura\chatgame\ChatGame;

final class Settings{
    private static array $contents = [];

    public static function init(): void{
        ChatGame::getInstance()->saveConfig();
        //self::$contents = ChatGame::getInstance()->getConfig()->getAll();
        self::$contents = yaml_parse_file(ChatGame::getInstance()->getDataFolder() . "config.yml");
    }

    /**
     * @return array
     */
    public static function getContents(): array{
        return self::$contents;
    }

}