<?php

$guessingWords = ["welcome", "length", "subway", "nightclub", "garlic", "matrix", "whiskey"];


function generateWordToGuess(array $guessingWords): string {
    return $guessingWords[array_rand($guessingWords)];
}

function wordToGuessArray(string $wordToGuess): array {
    $wordToGuessHidden = [];
    for ($i = 1; $i <= strlen($wordToGuess); $i++) {
        $wordToGuessHidden[] = "_";
    }
    return $wordToGuessHidden;
}

$misses = "";

$wordToGuess = generateWordToGuess($guessingWords);
$wordToGuessHidden = wordToGuessArray($wordToGuess);

$finish = false;
$playAgain = "";

while (!$finish) {
    echo "-=-=-=-=-=-=-=-=-=-=-=-=-=-" . PHP_EOL;
    echo "Word:   ";
    foreach ($wordToGuessHidden as $letter) {
        echo $letter . " ";
    }
    echo PHP_EOL;
    echo "Misses: " . $misses . PHP_EOL;

    if (strlen($misses) >= 5) {
        echo "Game over! You have missed 5 letters." . PHP_EOL . "The word was '{$wordToGuess}'." . PHP_EOL;
        $playAgain = readline('Play "again" or "quit"? ');
    }

    if (in_array("_", $wordToGuessHidden)) {
        $guessedLetter = readline("Guess:  ");
        if (strlen($guessedLetter) > 1) {
            echo "Invalid input! Only one letter is allowed." . PHP_EOL;
            continue;
        } elseif (!in_array($guessedLetter, range("a", "z"))) {
            echo "Invalid input! Only letters are allowed." . PHP_EOL;
            continue;
        }
        $checkLetter = strpos($wordToGuess, $guessedLetter);
        if ($checkLetter === false) {
            if (strpos($misses, $guessedLetter) === false)
            {
                $misses .= $guessedLetter;
            }
            if (strlen($misses) >= 5) {
                echo "Game over! You have missed 5 letters." . PHP_EOL . "The word was '{$wordToGuess}'." . PHP_EOL;
                $playAgain = readline('Play "again" or "quit"? ');
            }
        } else {
            $wordToGuessHidden[$checkLetter] = $guessedLetter;
        }
    } else {
        echo "YOU GOT IT!" . PHP_EOL;
        $playAgain = readline('Play "again" or "quit"? ');
    }

    while (!in_array($playAgain, ["quit", "again", ""])) {
        echo "Invalid input!" . PHP_EOL;
        $playAgain = readline('Play "again" or "quit"? ');
    }

    if ($playAgain === "quit") {
        $finish = true;
    } elseif ($playAgain === "again") {
        $playAgain = "";
        $wordToGuess = generateWordToGuess($guessingWords);
        $wordToGuessHidden = wordToGuessArray($wordToGuess);
        $misses = "";
    }
}



