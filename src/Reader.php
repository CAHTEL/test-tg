<?php

/**
 * @param string $year
 * @return array
 * Get expenses for a specific year
 * Format: Y
 * Example: 2024
 * Return: array
 * [
 *  "2024-09-14" => [
 *      "1000",
 *      "2000"
 *  ]
 * ]
 */
function getYearExpenses(string $year): array
{
    $files = scandir(__DIR__ . "/../storage");
    $files = array_filter($files, function ($file) use ($year) {
        return $file !== "." && $file !== ".." && mb_strpos($file, $year) !== false;
    });
    return formatFromFiles($files);
}

/**
 * @return array
 * Get all expenses
 * Return: array
 * [
 * "2024-09-14" => [
 *     [
 *        "expense" => 1000,
 *       "comment" => "test"
 *    ],
 */
function getAllExpenses(): array
{
    $files = scandir(__DIR__ . "/../storage");
    $files = array_filter($files, function ($file) {
        return $file !== "." && $file !== "..";
    });
    return formatFromFiles($files);
}


/**
 * @param string $month
 * @param string $year
 * @return array
 * Get expenses for a specific month
 * Format: m
 * Example: 09
 * Return: array
 * "2024-09-14" => [
 *     [
 *         "expense" => 1000,
 *        "comment" => "test"
 *     ],
 * ]
 */
function getMonthExpenses(string $month, string $year): array
{
    $files = scandir("./storage");
    $files = array_filter($files, function ($file) use ($month, $year) {
        return mb_strpos($file, $year . "-" . $month) !== false;
    });
    return formatFromFiles($files);
}

/**
 * @param string $day
 * @return array
 * Get expenses for a specific day
 * Format: Y-m-d
 * Example: 2024-09-14
 * Return: array
 * [
 *  "1000",
 *  "2000"
 * ]
 */
function getDayExpenses(string $day): array
{
    $fileName = __DIR__ . "/../storage/" . $day . ".txt";
    if (!file_exists($fileName)) {
        return [];
    }

    return [$day => formatFromFile($fileName)];
}


/**
 * @param false|array $files
 * @return array
 */
function formatFromFiles(false|array $files): array
{
    $result = [];
    foreach ($files as $file) {
        $fileName = __DIR__ . "/../storage/" . $file;
        $result[mb_substr($file, 0, mb_strpos($file, "."))] = formatFromFile($fileName);
    }

    return $result;
}

/**
 * @param string $fileName
 * @return array
 */
function formatFromFile(string $fileName): array
{
    $content = file_get_contents($fileName);
    $expenses = explode(PHP_EOL, $content);
    $expenses = array_filter($expenses, function ($expense) {
        return !empty($expense);
    });
    return array_map(function ($expense) {
        $expense = explode(",", $expense);
        return ['expense' => (int)$expense[0], 'comment' => $expense[1]];
    }, $expenses);
}