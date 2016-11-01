<?php

abstract class User {
    /**
     * Creating new player
     */
    public function setName($name) 
    {
        $this->name = $name;
    }

    /**
     * Getting current player
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Getting current player blood
     */
    public function decreaseBlood($value)
    {
        $this->blood -= $value;
    }
    
    /**
     * Getting current player blood
     */
    public function decreaseMana($value)
    {
        $this->mana -= $value;
    }

    /**
     * Getting current player blood
     */
    public function getBlood()
    {
        return $this->blood;
    }

    /**
     * Getting current player mana
     */
    public function getMana()
    {
        return $this->mana;
    }

    /**
     * Creating new player blood and mana value
     */
    public function setBloodAndMana($blood, $mana) 
    {
        $this->blood = $blood;
        $this->mana = $mana;
    }
}

/**
 * Describe the enemy profile
 * 
 */
class Enemy extends User
{
    /**
     * Blood Property
     */
    protected $blood = 100;

    /** 
     * Mana Property
     */
    protected $mana = 40;

    /**
     * Name Property
     */
    protected $name = 'Enemy';

}

class Player extends User
{
    /**
     * Blood Property
     */
    protected $blood;

    /** 
     * Mana Property
     */
    protected $mana;

    /**
     * Name Property
     */
    protected $name;
}

$player = new Player();
$enemy = new Enemy();

$fp = fopen('php://stdin', 'r');
$last_line = false;
$status = '';
$message = "# Current Player: # \n# - #";
$battleMessage = "who will attack: {$player->getName()} \nwho will defend: {$enemy->getName()}\n";

/**
 * Message Display
 */
$head = <<<EOD

# ============================== #
# Welcome to the Battle Arena #
# ----------------------------------------------------- #
# Description: #
# 1 type "new" to create a character #
# 2. type "start" to begin the fight #
# ----------------------------------------------------- #

EOD;

$battleHead = <<<EOD

# ============================== #
# Welcome to the Battle Arena #
# ----------------------------------------------------- #
Battle Start:

EOD;

$foot = <<<EOD

# * Max player 2 or 3 #
# ----------------------------------------------------- #
Your Command: 
EOD;

print $head;
print $message;
print $foot;

while (!$last_line) {
    $next_line = fgets($fp, 1024);

    switch ($next_line) {
        case ".\n":
            $last_line = true;
            break;
        
        case "new\n":
            if (! empty($player->getName())) {
                $message = "# Current Player: <name_player> # \n# - <{$player->getName()}>";
            } else {
                $message = "# Put Player Name: <name_player> # \n# - #";
                $status = 'new';
            }
            print $head;
            print $message;
            print $foot;
            break;
        
        case "start\n":
            if (empty($player->getName())) {
                $message = "# Current Player: <name_player> # \n# - #";

                print $head;
                print $message;
                print $foot;
            } else {
                $status = 'battle';
                $battleMessage = "who will attack: {$player->getName()} \nwho will defend: {$enemy->getName()}\n";

                print $battleHead;
                print $battleMessage;
            }
            break;
        
        case "\n":
            if (empty($player->getName())) {
                $message = "# Current Player: <name_player> # \n# - #";

                print $head;
                print $message;
                print $foot;
            } else {
                if ($status == 'battle') {
                    $status = 'battle';
                    $player->decreaseMana(10);
                    $enemy->decreaseBlood(25);

                    // if player or enemy rest is count to zero
                    if ($player->getBlood() < 1 || $player->getMana() < 1 || $enemy->getBlood() < 1 || $enemy->getMana() < 1) {
                        // reset status and rest
                        $status = '';
                        $player->setBloodAndMana(100, 40);
                        $enemy->setBloodAndMana(100, 40);

                        // display the game over message
                        $message = "# | * * * Game Over - Retreat * * * |\n# Current Player: <name_player> # \n# - <{$player->getName()}>";
                        $status = '';
                        print $head;
                        print $message;
                        print $foot;
                    } else {
                        $battleMessage = "who will attack: {$player->getName()} \nwho will defend: {$enemy->getName()}\nDescription: \n<{$player->getName()}>: mana = <{$player->getMana()}>, blood = <{$player->getBlood()}> \n<{$enemy->getName()}>: mana = <{$enemy->getMana()}>, blood = <{$enemy->getBlood()}> \n<press Enter to Attack>";

                        print $battleHead;
                        print $battleMessage;
                    }
                } else {
                    // if status is not battle
                    $message = "# Current Player: <name_player> # \n# - <{$player->getName()}>";

                    print $head;
                    print $message;
                    print $foot;
                }
            }
            break;

        default:
            // if status is creating new player
            if ($status == 'new') {
                $next_line = rtrim($next_line, "\n");
                $player->setName($next_line);
                $player->setBloodAndMana(100, 40);
                $message = "# Current Player: <name_player> # \n# - <{$player->getName()}>";
                $status = '';
            } else {
                if (! empty($player->getName())) {
                    $message = "# Current Player: <name_player> # \n# - <{$player->getName()}>";
                } else {
                    $message = "# Current Player: # \n# - #";
                }
            }

            print $head;
            print $message;
            print $foot;
            break;
    }
}