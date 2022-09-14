<?php

namespace Asura\chatgame\games\types;

use Asura\chatgame\ChatGame;
use Asura\chatgame\games\Game;
use Asura\chatgame\task\ChatGameRunTask;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class ScrambleGame extends Game{

    /** @var string[] */
    private array $words = [];

    protected ?string $answer = null;

    /**
     * @param string $identifier
     * @param string[] $words
     */
    public function __construct(string $identifier, array $words = []){
        parent::__construct($identifier);
        $this->init($words);
    }

    /**
     * @param string[] $values
     * @return void
     */
    public function init(mixed $values): void{
        foreach ($values as $word) {
            $this->words[$word] = str_shuffle($word);
        }
    }

    /**
     * @return string[]
     */
    public function getWords(): array{
        return $this->words;
    }

    public function getAnswerFor(string $word): string{
        $values = array_values($this->words);
        $keys = array_keys($this->words);
        return $keys[array_search($word, $values, true)];
    }

    public function activate(): void{
        parent::activate();
        $this->setActivated(true);
        $this->init([
            "Steve",
            "Asura",
            "HCF",
            "AppGallery",
            "Ecuador",
            "Panama"
        ]);
        $selected = $this->words[array_rand($this->words)];
        $this->answer = $this->getAnswerFor($selected);
        var_dump($this->answer);
        Server::getInstance()->broadcastMessage(TextFormat::colorize("&6Se ha activado el evento de descifrar la palabra: &a" . $selected));
    }

    public function checkAnswer(string $answer): bool{
        return $this->getAnswer() == $answer;
    }

}