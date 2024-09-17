<?php

function printData(array $data): void
{
    foreach ($data as $key => $value) {
        echo "date: " . $key . PHP_EOL;
        foreach ($value as $expense) {
            echo "expense: " . $expense['expense'] . "| comment: " . $expense['comment'] . PHP_EOL;
        }
    }
}

