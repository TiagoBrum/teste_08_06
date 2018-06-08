<?php

class FizzBuzz
{

    public function printa()
    {
        $inicio = 1;

        while ($a <= 100) {
            $result = '';

            if ($a % 3 == 0) {
                $result .= 'Fizz';
            }

            if ($a % 5 == 0) {
                $result .= 'Buzz';
            }

            echo $result ? $result . '<br>' : '';

            $a++;
        }
    }
}

$fB = new FizzBuzz();
$fB->printa();
