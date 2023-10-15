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
        echo 'LまたはRを使用した文字列を入力してください' . PHP_EOL;
    } else {
        $input = $lines[0];
        $isValid = validateInput($input);

        if(!$isValid) {
            echo '10文字以内のLまたはRを使用した文字列を入力してください' . PHP_EOL;
        } else {
            $stones = 'bw';

            for($i = 0; $i < strlen($input); $i++) {
                $stones = putNewStone($stones, $input[$i], $i + 1);
            }
            $result = countStones($stones);
    
            echo $result . PHP_EOL;
        }
    }
}

/**
 * 新しい石を置く
 * 
 * @param string $stones マス上の石の配置
 * @param string $side 石を置く側（左側または右側）
 * @param int $n 石を置くターン数
 * @return string 更新された石の配置
 */
function putNewStone(string $stones, string $side, int $n): string
{
    $newStone = $n % 2 === 1 ? 'b' : 'w';
    $stones = $side === 'L' ? $newStone . $stones : $stones . $newStone;
    $shouldReverse = shouldReverse($stones, $side);

    if($shouldReverse) {
        $stones = reverseStones($stones, $side);
    }
    return $stones;
}

/**
 * 石を反転させる必要があるかどうかを判定する
 * 
 * @param string $stones マス上の石の配置
 * @param string $side 石を置く側（左側または右側）
 * @return bool 反転させる必要があるかどうかを示す真偽値
 */
function shouldReverse(string $stones, string $side): bool
{
    $startIndex = $side === 'L' ? 0 : strlen($stones) - 1;

    if($side === 'L' && $stones[$startIndex] != $stones[$startIndex + 1]) {
        while ($startIndex < strlen($stones) - 2) {
            $startIndex++;

            if($stones[$startIndex] != $stones[$startIndex + 1]) {
                return true;
            }
        }
    } elseif ($side === 'R' && $stones[$startIndex] != $stones[$startIndex - 1]) {
        while ($startIndex - 1 > 0) {
            $startIndex--;

            if($stones[$startIndex] != $stones[$startIndex - 1]) {
                return true;
            }
        }
    }
    return false;
}

/**
 * 石を反転させる
 * 
 * @param string $stones マス上の石の配置
 * @param string $side 石を置く側（左側または右側）
 * @return string 反転後のマスの石の配置
 */
function reverseStones(string $stones, string $side): string
{
    $startIndex = $side === 'L' ? 0 : strlen($stones) - 1;
    
    if ($side === 'L') {
        while ($startIndex < strlen($stones)) {
            $stones[$startIndex + 1] = $stones[$startIndex];
            $startIndex++;

            if($stones[$startIndex] === $stones[$startIndex + 1]) {
                break;
            }
        }
    } else {
        while ($startIndex >= 0) {
            $stones[$startIndex - 1] = $stones[$startIndex];
            $startIndex--;

            if($stones[$startIndex] === $stones[$startIndex + 1]) {
                break;
            }
        }
    }
    return $stones;
}

/**
 * `マス上の石の数を数える
 * 
 * @param string $stones マス上の石の配置
 * @return string 黒の石の数と白の石の数
 */
function countStones(string $stones): string
{
    $blackCount = 0;
    $whiteCount = 0;

    for($i = 0; $i < strlen($stones); $i++) {
        $stones[$i] === 'b'? $blackCount++ : $whiteCount++;
    }
    return $blackCount . ' ' . $whiteCount;
}

/**
 * 入力文字列を検証する
 * 11文字以上の場合、'L' または 'R' 以外の文字が含まれている場合に false を返す
 *
 * @param string $input 入力文字列
 * @return bool 制約に反していないかどうかを示す真偽値
 */
function validateInput(string $input): bool
{
    if(strlen($input) > 10) {
        return false;
    }
    for($i = 0; $i < strlen($input); $i++) {
        if($input[$i] !== 'L' && $input[$i] !== 'R') {
            return false;
        }
    }
    return true;
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