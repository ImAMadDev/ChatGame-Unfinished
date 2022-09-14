<?php

namespace Asura\chatgame\games\types;

use Asura\chatgame\games\Game;

class MathematicsGame extends Game{

    private array $exercises = [];

    public function __construct(string $identifier, array $exercises){
        parent::__construct($identifier);
        $this->init($exercises);
    }

    public function init(mixed $values){

    }

    public function activate(): void{
        // TODO: Implement activate() method.
    }

    public function checkAnswer(string $answer): bool{
        // TODO: Implement checkAnswer() method.
    }
}