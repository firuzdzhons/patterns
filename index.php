<?php

class Character {
    public string $name;
    public float $health;
    public float $power;

    public function __construct($name, $health, $power)
    {
        $this->name = $name;
        $this->health = $health;
        $this->power = $power;
    }

    public function run() {
        echo 'run';
    }

    public function defend() {
        echo 'defend';
    }
}


class Weapon {
    //describe weapon
}

class Warrior extends Character 
{
    public Weapon $weapon;

    public function __construct($name, $health, $power, $weapon)
	{
		parent::__construct($name, $health, $power);

		$this->weapon = $weapon;
	}

    public function hit()
    {
        echo 'hit with '.$this->power;
    }
}

class Mage extends Character 
{
    public Weapon $weapon;

    public string $spells;

    public function __construct($name, $health, $power, $spells)
	{
		parent::__construct($name, $health, $power);

		$this->spells = $spells;
	}

    public function conjure()
    {
        echo 'conjure use '.$this->power;
    }
}


abstract class CharacterFactory {
    abstract public function createCharacter($name, $health, $power): Character;

    // public function getName($name, $health, $power): string
    // {
    //     $character = $this->createCharacter($name, $health, $power);
    //     return $character->name;
    // }
}

class WarriorFactory extends CharacterFactory
{
    public function createCharacter($name, $health, $power): Character
    {
        return new Warrior($name, $health, $power, new Weapon());
    }
}

class MageFactory extends CharacterFactory
{
    public function createCharacter($name, $health, $power): Character
    {
        return new Mage($name, $health, $power, 'some spells');
    }
}


function clientCode(CharacterFactory $characterFactory)
{
    $character = $characterFactory->createCharacter("Warrior1", 90, 90);
    echo $character->name;
    echo "\n\n";
}

clientCode(new WarriorFactory());


