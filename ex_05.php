<?php

$board = [
    [" ", " ", " "],
    [" ", " ", " "],
    [" ", " ", " "]
];

function display_board(array $board)
{
    echo " {$board[0][0]} | {$board[0][1]} | {$board[0][2]} \n";
    echo "---+---+---\n";
    echo " {$board[1][0]} | {$board[1][1]} | {$board[1][2]} \n";
    echo "---+---+---\n";
    echo " {$board[2][0]} | {$board[2][1]} | {$board[2][2]} \n";
}

$player1 = "X";
$player2 = "O";

function isWinner(array $board): string {
    for ($i = 0; $i < 3; $i++) {
        if ($board[$i][0] === $board[$i][1] && $board[$i][1] === $board[$i][2] && $board[$i][0] !== " ") {
            return $board[$i][0];
        }
    }
    for ($i = 0; $i < 3; $i++) {
        if ($board[0][$i] === $board[1][$i] && $board[1][$i] === $board[2][$i] && $board[0][$i] !== " ") {
            return $board[0][$i];
        }
    }
    if ($board[0][0] === $board[1][1] && $board[1][1] === $board[2][2] && $board[0][0] !== " ") {
        return $board[0][0];
    } elseif ($board[0][2] === $board[1][1] && $board[1][1] === $board[2][0] && $board[0][2] !== " ") {
        return $board[0][2];
    } else {
        return " ";
    }
}

function checkEmptySlots(array $board): bool {
    $checkRow0 = in_array(" ", $board[0]);
    $checkRow1 = in_array(" ", $board[1]);
    $checkRow2 = in_array(" ", $board[2]);
    if (!$checkRow0 && !$checkRow1 && !$checkRow2) {
        return false;
    } else {
        return true;
    }
}

$turn = $player1;

while (isWinner($board) === " " && checkEmptySlots($board) === true)
{
    display_board($board);

    $location = readline("'{$turn}', choose your location (row, column): ");
    $cleanLocation = preg_replace('~\D~', "", $location);
    $validInput = "012";
    if ($cleanLocation === "") {
        echo "Invalid input!" . PHP_EOL;
        continue;
    }

    $row = $cleanLocation[0];
    $column = $cleanLocation[1];

    if (strpos($validInput, $row) === false || strpos($validInput, $column) === false) {
        echo "Invalid input!" . PHP_EOL;
        continue;
    }

    if ($board[$row][$column] === " ") {
        $board[$row][$column] = $turn;
    } else {
        echo "This location is taken!" . PHP_EOL;
    }

    if (isWinner($board) === " " && $turn === $player1) {
        $turn = $player2;
    } else {
        $turn = $player1;
    }
}

display_board($board);

if (isWinner($board) === $player1) {
    echo "'{$player1}' has won!";
} elseif (isWinner($board) === $player2) {
    echo "'{$player2}' has won!";
}

if (checkEmptySlots($board) === false && isWinner($board) === " ") {
    echo "The game is a tie." . PHP_EOL;
}









