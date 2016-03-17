<?php

/**
 * Class Multiplos
 * Escreva um programa que imprima números de 1 a 100. Mas, para múltiplos de 3 imprima
 * “Fizz” em vez do número e para múltiplos de 5 imprima “Buzz”. Para números múltiplos
 * de ambos (3 e 5), imprima “FizzBuzz”.
 *
 */
class Multiple
{
    public function verifyFizzBuzz($start, $end)
    {
        $result = '';
        for ($i = $start; $i <= $end; $i++) {
            if ($i % 3 == 0 && $i % 5 == 0) {
                $result .= 'FizzBuzz<br>';
            } elseif ($i % 3 == 0) {
                $result .= 'Fizz<br>';
            } elseif ($i % 5 == 0) {
                $result .= 'Buzz<br>';
            } else {
                $result .= $i . '<br>';
            }
        }
        return $result;
    }
}

$multiple = new Multiple;
echo $multiple->verifyFizzBuzz(1, 100);
