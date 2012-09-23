<?php
/**
 * Created by JetBrains PhpStorm.
 * User: akhilesh
 * Date: 28/4/12
 * Time: 5:51 PM
 * To change this template use File | Settings | File Templates.
 */

class test2 extends CI_Controller
{


    function number()
    {


        echo $this->convert_number_to_words(123);
        echo '<br>';
        echo $this->convertNumberToWordsForIndia(123);

    }


//---
    function convertNumberToWordsForIndia($number)
    {
        //A function to convert numbers into Indian readable words with Cores, Lakhs and Thousands.
        $words = array(
            '0' => '', '1' => 'one', '2' => 'two', '3' => 'three', '4' => 'four', '5' => 'five',
            '6' => 'six', '7' => 'seven', '8' => 'eight', '9' => 'nine', '10' => 'ten',
            '11' => 'eleven', '12' => 'twelve', '13' => 'thirteen', '14' => 'fouteen', '15' => 'fifteen',
            '16' => 'sixteen', '17' => 'seventeen', '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
            '30' => 'thirty', '40' => 'fourty', '50' => 'fifty', '60' => 'sixty', '70' => 'seventy',
            '80' => 'eighty', '90' => 'ninty');

        //First find the length of the number
        $number_length = strlen($number);
        //Initialize an empty array
        $number_array = array(0, 0, 0, 0, 0, 0, 0, 0, 0);
        $received_number_array = array();

        //Store all received numbers into an array
        for ($i = 0; $i < $number_length; $i++) {
            $received_number_array[$i] = substr($number, $i, 1);
        }

        //Populate the empty array with the numbers received - most critical operation
        for ($i = 9 - $number_length, $j = 0; $i < 9; $i++, $j++) {
            $number_array[$i] = $received_number_array[$j];
        }
        $number_to_words_string = "";
        //Finding out whether it is teen ? and then multiplying by 10, example 17 is seventeen, so if 1 is preceeded with 7 multiply 1 by 10 and add 7 to it.
        for ($i = 0, $j = 1; $i < 9; $i++, $j++) {
            if ($i == 0 || $i == 2 || $i == 4 || $i == 7) {
                if ($number_array[$i] == "1") {
                    $number_array[$j] = 10 + $number_array[$j];
                    $number_array[$i] = 0;
                }
            }
        }

        $value = "";
        for ($i = 0; $i < 9; $i++) {
            if ($i == 0 || $i == 2 || $i == 4 || $i == 7) {
                $value = $number_array[$i] * 10;
            }
            else {
                $value = $number_array[$i];
            }
            if ($value != 0) {
                $number_to_words_string .= $words["$value"] . " ";
            }
            if ($i == 1 && $value != 0) {
                $number_to_words_string .= "Crores ";
            }
            if ($i == 3 && $value != 0) {
                $number_to_words_string .= "Lakhs ";
            }
            if ($i == 5 && $value != 0) {
                $number_to_words_string .= "Thousand ";
            }
            if ($i == 6 && $value != 0) {
                $number_to_words_string .= "Hundred &amp; ";
            }
        }
        if ($number_length > 9) {
            $number_to_words_string = "Sorry This does not support more than 99 Crores";
        }
        return ucwords(strtolower($number_to_words_string));
    }

//    --
//correct one
    function convert_number_to_words($number)
    {

        $hyphen = '-';
        $conjunction = ' and ';
        $separator = ', ';
        $negative = 'negative ';
        $decimal = ' point ';
        $dictionary = array(
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
            20 => 'twenty',
            30 => 'thirty',
            40 => 'fourty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety',
            100 => 'hundred',
            1000 => 'thousand',
            1000000 => 'million',
            1000000000 => 'billion',
            1000000000000 => 'trillion',
            1000000000000000 => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . $this->convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int)($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . $this->convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int)($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= $this->convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string)$fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }


//    -- words to string

    function words()
    {
//        $str = ' two hundred and thirty thousand, seven hundred and eighty-three ';
        $str = ' eighty-one ';

        function strlen_sort($a, $b)
        {
            if (strlen($a) > strlen($b)) {
                return -1;
            }
            else if (strlen($a) < strlen($b)) {
                return 1;
            }
            return 0;
        }

        $keys = array(
            'one' => '1', 'two' => '2', 'three' => '3', 'four' => '4', 'five' => '5', 'six' => '6', 'seven' => '7', 'eight' => '8', 'nine' => '9',
            'ten' => '10', 'eleven' => '11', 'twelve' => '12', 'thirteen' => '13', 'fourteen' => '14', 'fifteen' => '15', 'sixteen' => '16', 'seventeen' => '17', 'eighteen' => '18', 'nineteen' => '19',
            'twenty' => '20', 'thirty' => '30', 'forty' => '40', 'fifty' => '50', 'sixty' => '60', 'seventy' => '70', 'eighty' => '80', 'ninety' => '90',
            'hundred' => '100', 'thousand' => '1000', 'million' => '1000000', 'billion' => '1000000000'
        );


        preg_match_all('#((?:^|and|,| |-)*(\b' . implode('\b|\b', array_keys($keys)) . '\b))+#i', $str, $tokens);
        //print_r($tokens); exit;
        $tokens = $tokens[0];
        usort($tokens, 'strlen_sort');

        foreach ($tokens as $token)
        {
            $token = trim(strtolower($token));
            preg_match_all('#(?:(?:and|,| |-)*\b' . implode('\b|\b', array_keys($keys)) . '\b)+#', $token, $words);
            $words = $words[0];
            //print_r($words);
            $num = '0';
            $total = 0;
            foreach ($words as $word)
            {
                $word = trim($word);
                $val = $keys[$word];
                //echo "$val\n";
                if (bccomp($val, 100) == -1) {
                    $num = bcadd($num, $val);
                    continue;
                }
                else if (bccomp($val, 100) == 0) {
                    $num = bcmul($num, $val);
                    continue;
                }
                $num = bcmul($num, $val);
                $total = bcadd($total, $num);
                $num = '0';
            }
            $total = bcadd($total, $num);
                        echo "new $total:$token\n";
//            echo "new $total\n";
            $str = preg_replace("#\b$token\b#i", number_format($total), $str);
        }
        echo "\n$str\n";
    }

    // --revers the string

    function  revers()
    {

        echo strrev("arunesh saxena is good boy.");
        echo '<br>';

        $str_name = 'arunesh saxena is the good boy.';
        $len = strlen($str_name);
        //echo $len;
        $i = $len;
        for ($i; $i > -1; $i--)
            //$i>-1 because in array Ist element is start with 0th position.
        {
            echo $str_name[$i];
        }
    }

    // prime number

    function prime()
    {
        echo  $this->get_prime(3);
    }

    function get_prime($nth, $t = false, $tCheck = 1000)
    {
        // Transform the arguments into a common form and discard bad n-th's
        $singular = !is_array($nth);
        $nth = array_filter((array)$nth,
            function($n)
            {
                return is_int($n) && $n > 0;
            });
        if (!$nth) return $singular ? null : array();

        // The n-th prime we're aiming for
        $n = max($nth);

        // The first prime is the only even one
        $primes = array(1 => 2);
        if ($n == 1) {
            return $singular ? $primes[1] : $primes;
        }

        // Loop counters
        $c = 1;
        $p = 3;
        $begin = microtime(true);

        while (true)
        {
            // Check if $p is prime
            $prime = true;
            $sqrt = sqrt($p);
            for ($i = 1; $i < $c && $primes[$i] <= $sqrt; $i++) {
                if ($p % $primes[$i] == 0) {
                    $prime = false;
                    break;
                }
            }
            // Record $p if prime
            if ($prime) {
                $primes[++$c] = $p;
                if ($c == $n) {
                    break;
                }
            }
            // Check if time limit expired (every $tCheck passes)
            if ($t && ($p % $tCheck <= 1) && (microtime(true) - $begin) > $t) {
                break;
            }
            // Next $p to check
            $p += 2;
        }

        if ($singular) {
            return isset($primes[$n]) ? $primes[$n] : null;
        } else {
            return array_intersect_key($primes, array_fill_keys($nth, null));
        }
    }


//    fabionic

    function fab()
    {
        $count = 2;
        $i = $count - 2;

        $f0 = 2; /* declaring variables */
        $f1 = 2;
        $f2 = 0;
        $sum = $f0 + $f1;

        $n = 0; /* the series range */
        echo $f0 . '<br>' . $f1 . '<br>';
        while ($n < $i)
        {
            $f2 = $f0 + $f1;
            echo $f2 . "<br>";
            $sum = $sum + $f2;
            $f0 = $f1;
            $f1 = $f2;
            $n++;
        }
        echo 'sum=' . $sum . '<br>';
        echo 'mode=' . $sum % 21;
    }

    function test_curl(){
        echo "test";
//        $result = true;
//        return $result;
    }


}