<?php

namespace Asura\chatgame\games\types;

use Asura\chatgame\games\Game;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class QuestionGame extends Game{

    private array $questions = [];

    public function __construct(string $identifier, array $questions = []){
        parent::__construct($identifier);
        $this->init($questions);
    }

    public function init(mixed $values): void{
        foreach ($values as $question => $answer) {
            if (is_array($answer)) {
                foreach ($answer as $item) {
                    $this->questions[$question][] = $item;
                }
            } else {
                $this->questions[$question] = $answer;
            }
        }
    }

    /**
     * @return string[]
     */
    public function getQuestions(): array{
        return $this->questions;
    }

    public function getAnswerFor(string $question): array{
        return is_array($this->questions[$question]) ? $this->questions[$question] : [$this->questions[$question]];
    }

    public function activate(): void{
        parent::activate();
        $this->setActivated(true);
        $keys = array_keys($this->questions);
        $selected = $keys[array_rand($keys)];
        var_dump($selected);
        var_dump($this->getAnswerFor($selected));
        $this->answer = $selected;
        Server::getInstance()->broadcastMessage(TextFormat::colorize("&6Se ha activado el evento de pregunta: &a" . $selected));
    }

    public function checkAnswer(string $answer): bool{
        foreach ($this->getAnswerFor($this->answer) as $item) {
            if ($answer == $item){
                return true;
            }
        }
        return false;
    }
}