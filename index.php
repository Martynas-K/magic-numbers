<?php
declare(strict_types=1);

// -- P.S. I have little experience with Java yet, so I wrote this in PHP.

// -- Initial input value
$input = 142857;

// -- Incorrect test input value
//$input = 142858;

//-- Service functions
/**
 * Returns the number of digits of given integer
 * @param $num
 * @return int
 */
function countDigits($num): int
{
    return strlen((string)$num);
}

/**
 * Returns an array of given integer's digits
 * @param $num
 * @return array
 */
function getDigitsArray($num): array
{
    return array_map('intval', str_split((string) $num));
}

/**
 * Returns an array of all Magic number's permutations
 * @param $num
 * @param $numberLength
 * @return array
 */
function getNumbersArray ($num, $numberLength): array
{
    $numbersArray = [];
    for ($i=1; $i <= $numberLength; $i++) {
        $number = $num * $i;
        array_push($numbersArray, $number);
    }
    return $numbersArray;
}

// -- Initial calculations with given input value
$arrayOfInputDigits = getDigitsArray($input);
$inputLength = countDigits($input);
$magicNumbersArray = getNumbersArray($input, $inputLength);

// -- Checking if input value is a magic number
/**
 * @param $magicNumbersArray
 * @param $arrayOfInputDigits
 * @param $inputLength
 * @return string
 */
function checkMagic ($magicNumbersArray, $arrayOfInputDigits, $inputLength): string
{
    foreach ($magicNumbersArray as $array) {
        // Creates an array of digits of given number
        $arrayOfNumberDigits = getDigitsArray($array);

        // Finds the index of the chosen (first) digit of input number in given number
        $firstInputDigitKey = (int) array_search($arrayOfInputDigits[0], $arrayOfNumberDigits);

        // Determines the number of digits to slice
        $endDigitsToSlice = $inputLength - $firstInputDigitKey;

        // Slices array into two and adds them up again starting with chosen the digit
        $slicedEnd = array_slice($arrayOfNumberDigits, $firstInputDigitKey, $endDigitsToSlice, true);
        $slicedBeginning = array_slice($arrayOfNumberDigits, 0, $firstInputDigitKey, true);
        $reindexedNumberArray = $slicedEnd + $slicedBeginning;

        // Re-indexes newly formed array
        $reindexedNumberArray = array_values($reindexedNumberArray);

        // Checks if the newly formed number is equal to input number
        $answer = 'It\'s magic!';
        if ($reindexedNumberArray !== $arrayOfInputDigits) {
            $answer = 'This ain\'t no magic!';
            break;
        }
    }
    /** @var string $answer */
    return $answer;
}

// -- Printing out result
echo checkMagic($magicNumbersArray, $arrayOfInputDigits, $inputLength);





