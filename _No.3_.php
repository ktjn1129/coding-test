<?php namespace Track;

ini_set("memory_limit", -1);

/**
 * メイン関数
 * 
 * @param array $lines 入力の配列
 * @return void
 */
function main(array $lines): void
{
    if (empty($lines)) {
        echo '1から100桁の整数を入力してください' . PHP_EOL;
    } else {
        $input = $lines[0];

        if (!is_numeric($input) || strlen($input) > 100) {
            echo '1から100桁の整数を入力してください' . PHP_EOL;
        } else {
            $result = searchMinNumber($input);

            echo $result . PHP_EOL;
        }
    }
}

/**
 * すべての桁の数字を入れ替えた整数のうち最小の数を返す
 * 
 * @param string $number 入力数値
 * @return int 最小の数
 */
function searchMinNumber(string $number): int
{
    $array = array();

    for($i = 0; $i < strlen($number); $i++) {
        array_push($array, $number[$i]);
    }
    sort($array);

    if ($array[0] == 0) {
        for ($i = 1; $i < count($array); $i++) {
            if ($array[$i] != 0) {
                $temp = $array[0];
                $array[0] = $array[$i];
                $array[$i] = $temp;
                break;
            }
        }
    }
    $result = implode("", $array);

    return (int)$result;
}

$array = array();

while (true) {
    $stdin = fgets(STDIN);

    if ($stdin == "\n") {
        break;
    }
    $array[] = rtrim($stdin);
}

main($array);