<?php

function calculateTotalExpenses(array $expenses): int
{
    $total = 0;
    foreach ($expenses as $dayExpenses) {
        foreach ($dayExpenses as $expense) {
            $total += $expense['expense'];
        }
    }

    return $total;
}
