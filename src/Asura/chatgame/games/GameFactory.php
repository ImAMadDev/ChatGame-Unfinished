<?php

namespace Asura\chatgame\games;

use Asura\chatgame\ChatGame;
use Asura\chatgame\games\types\QuestionGame;
use Asura\chatgame\games\types\ScrambleGame;
use Asura\chatgame\games\utils\Exercise;
use Asura\chatgame\task\ChatGameEnableTask;
use pocketmine\utils\SingletonTrait;
use pocketmine\utils\TextFormat;

class GameFactory{
    use SingletonTrait;

    /** @var Game[] */
    private static array $games = [];

    private static mixed $selectedGame = null;

    public function init(): void{
        self::$games['scramble'] = new ScrambleGame("scramble", [
            "Steve",
            "Asura",
            "HCF",
            "AppGallery",
            "Ecuador",
            "Panama"
        ]);
        self::$games['question'] = new QuestionGame("question", [
           "De que se asustan los Creepers?" => ["gatos", "gato"],
            "como se llama el servidor?" => "Asura"
        ]);
        ChatGame::getInstance()->getLogger()->info(TextFormat::GREEN . "Se han registrado " . count(self::$games) . " juegos!");
        $this->activateNewGame();
        ChatGame::getInstance()->getScheduler()->scheduleRepeatingTask(new ChatGameEnableTask(), 20);
    }

    /**
     * @return Game[]
     */
    public function getGames(): array{
        return self::$games;
    }

    public function getGame(string $type): Game{
        return match ($type){
            "scramble" => self::$games["scramble"],
            "question" => self::$games["question"]
        };
    }

    /**
     * @return mixed|null
     */
    public static function getSelectedGame(): mixed{
        return self::$selectedGame;
    }

    public function hasActivatedGame(): bool{
        foreach ($this->getGames() as $game) {
            if ($game->isActivated()){
                return true;
            }
        }
        return false;
    }

    public function activateNewGame(): void{
        if (rand(0, 1) === 0){
            self::$games["scramble"]->activate();
        } else {
            self::$games["question"]->activate();
        }
    }

}