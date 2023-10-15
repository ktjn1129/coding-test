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
        echo '整数を入力してください' . PHP_EOL;
    } else {
        $input = $lines[0];

        if (!is_numeric($input) ||  $input < 2 || $input > 100000) {
            echo '2以上100000以下の整数を入力してください' . PHP_EOL;
        } else {
            $result = calculateMinRollsToReachGoal($input);

            echo $result . PHP_EOL;
        }
    }
}

/**
 * ゴールに到達するまでの最小の回数を計算する
 * 
 * @param int $num 入力値
 * @return int 最小の回数
 */
function calculateMinRollsToReachGoal(int $num): int
{
    $spaces = $num - 1;
    $result = ceil($spaces / 6);

    return $result;
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