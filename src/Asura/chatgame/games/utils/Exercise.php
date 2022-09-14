<?php

namespace Asura\chatgame\games\utils;

final class Exercise{
    public const SUMA = 0;
    public const RESTA = 1;
    public const MULTIPLICACION = 2;
    public const DIVISION = 3;
    private int $type;
    private int $number1;
    private int $number2;

    public static function createRandom(): Exercise{
        return new Exercise(rand(0, 3), rand(10, 200), rand(10, 200));
    }

    public function __construct(int $type, int $number1, int $number2){
        $this->type = $type;
        $this->number1 = $number1;
        $this->number2 = $number2;
    }

    /**
     * @return int
     */
    public function getType(): int{
        return $this->type;
    }

    /**
     * @return int
     */
    public function getNumber1(): int{
        return $this->number1;
    }

    /**
     * @return int
     */
    public function getNumber2(): int{
        return $this->number2;
    }

    public function result(): int{
        return match ($this->type){
            self::SUMA => $this->getNumber1() + $this->getNumber2(),
            self::RESTA => $this->getNumber1() - $this->getNumber2(),
            self::MULTIPLICACION => $this->getNumber1() * $this->getNumber2(),
            self::DIVISION => $this->getNumber1() / $this->getNumber2()
        };
    }

    public function getTypeString(): string{
        return match ($this->type){
            self::SUMA => "Suma",
            self::RESTA => "Resta",
            self::MULTIPLICACION => "Multiplicacion",
            self::DIVISION => "Division",
            default => "Desconocido"
        };
    }

}