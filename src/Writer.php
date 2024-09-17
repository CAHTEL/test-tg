<?php

function writeExpense(string $expense, string $comment = ''): void
{
    $fileName = __DIR__ . "/../storage/" . date('Y-m-d') . ".txt";
    file_put_contents($fileName, $expense . ',' . $comment . PHP_EOL, FILE_APPEND);
}
