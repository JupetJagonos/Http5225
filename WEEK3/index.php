<?php


$mealTime = 6;

if
 ($mealTime >= 5 && $mealTime < 9) {
     $meal = "Breakfast";
    }
elseif 
    ($mealTime >= 12 && $mealTime < 14){
        $meal = "Lunch";
    }
elseif 
    ($mealTime >= 19 && $mealTime < 21) {
    $meal = "dinner";}
 else {
    $meal = " Animals are not fed!";
}

?>



<?php

$magicNumber = 12;

function FizzBuzz($magicNumber) {
    if ($magicNumber % 3 == 0 && $magicNumber % 5 == 0) {
        $magicWord = "FizzBuzz";
    } elseif ($magicNumber % 3 == 0) {
        $magicWord = "Fizz";
    } elseif ($magicNumber % 5 == 0) {
        $magicWord = "Buzz";
    } else {
        $magicWord = $magicNumber;
    }
    return $magicWord;
}

$magic = FizzBuzz($magicNumber);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<p><?php echo "Meal Time: " . $mealTime . ":00 - " . $meal; ?></p>

</body>
</html>
