<?php

namespace Asura\chatgame\games;

use Asura\chatgame\ChatGame;
use Asura\chatgame\task\ChatGameRunTask;

abstract class Game{

    private string $identifier;

    protected ?string $answer = null;

    protected bool $activated = false;
    protected ?ChatGameRunTask $task = null;

    private int $time = 60;

    public function __construct(string $identifier){
        $this->identifier = $identifier;
    }

    /**
     * @return int
     */
    public function getTime(): int{
        return $this->time;
    }

    /**
     * @param int $time
     * @return void
     */
    public function reduceTime(int $time): void{
        $this->time -= $time;
    }

    /**
     * @param ChatGameRunTask|null $task
     */
    public function setTask(?ChatGameRunTask $task): void{
        $this->task = $task;
    }

    /**
     * @param int $time
     */
    public function setTime(int $time): void{
        $this->time = $time;
    }

    /**
     * @return string
     */
    public function getIdentifier(): string{
        return $this->identifier;
    }

    /**
     * @return bool
     */
    public function isActivated(): bool{
        return $this->activated;
    }

    /**
     * @param bool $activated
     */
    public function setActivated(bool $activated): void{
        $this->activated = $activated;
    }

    /**
     * @return string|null
     */
    public function getAnswer(): ?string{
        return $this->answer;
    }

    abstract public function init(mixed $values);

    public function activate(): void{
        ChatGame::getInstance()->getScheduler()->scheduleRepeatingTask($this->task = new ChatGameRunTask($this), 20);
    }

    abstract public function checkAnswer(string $answer): bool;

    public function reset(): void{
        $this->setActivated(false);
        $this->answer = null;
        $this->task?->getHandler()?->cancel();
        $this->task = null;
        $this->setTime(60);
    }

}