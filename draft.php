<?php

function isWired($number, $power){
    $power_sum = 0;
    foreach (str_split("$number") as $digit){
        $power_sum += pow($digit, $power);
    }
    return $number == $power_sum;
}

function test_isWierd($max, $power){
    echo "<h2>Looking for numbers < $max, where sum of it's digits to the power $power give number itself.</h2>";

    for ($ii = 2; $ii < $max; $ii++){
        if(isWired($ii, $power)){
            echo "<p style='color: lightcoral; margin: 0; padding: 0'>$ii = ";
            $n_str = str_split("$ii");
            for($jj = 0; $jj < count($n_str); $jj++){
                echo "$n_str[$jj]^$power ";
                if($jj != count($n_str) - 1){
                    echo "+ ";
                }
            }
            echo "</p>";
        }
    }

    echo "<h3>==================================================</h3>";
}


function giveChange($number){
    $amounts = array(200, 100, 50, 20, 10, 5, 1);
    $result = array();
    foreach ($amounts as $element){
        $count = 0;
        while ($number >= $element){
            $count += floor($number / $element);
            $number %= $element;
        }
        if($count){
            array_push($result, array($element, $count));
        }
    }
    return $result;
}

function test_giveChange($number_of_tests){
    echo "<h2>Looking for a change for given sum</h2>";
    for($ii = 0; $ii < $number_of_tests; $ii++){
        $n = random_int(0, 10000);
        $change = giveChange($n);
        if($change){
            echo "<p style='color: lightblue;'> For $n change is: ";
            foreach ($change as $banknote){
                echo "$banknote[0]₼:$banknote[1] ";
            }
            echo "</p>";
        }
        else{
            echo "<p style='color: lightblue;'>There is no change for $n</p>";
        }
    }
    echo "<h3>==================================================</h3>";
}

function validateCardNumber($card_str){
    $sum = 0;
    $len = count(str_split($card_str));
    if($len != 15 && $len != 16 || !is_numeric($card_str)){
        return false;
    }
    $mode = $len == 15 ? 0 : 1;
    for($ii = 0; $ii < $len; $ii++){
        if($ii % 2 == $mode){
            $sum += $card_str[$ii];
        }
        else{
            $temp = $card_str[$ii];
            $temp *= 2;
            if($temp > 9){
                $temp -= 9;
            }
            $sum += $temp;
        }
    }
    return $sum % 10 == 0;
}

/**
 * @throws Exception
 */
function randomCardNumber($len){
    if($len != 15 && $len !=16){
        throw new Exception("Invalid card lenght.");
    }
    $res = "";
    for($ii = 0; $ii < $len; $ii++){
        $r = random_int(0,9);
        $res = $res."$r";
    }
    return $res;
}

function test_validateCardNumber($n_valid){
    echo "<h2>Finding $n_valid valid credit card numbers.</h2>";
    $counter = 0;
    while ($counter < $n_valid){
        $len = random_int(15,16);
        $cardNumber = randomCardNumber($len);
        if(validateCardNumber($cardNumber)){
            echo "<p style='color: lightgreen'>$cardNumber</p>";
            $counter++;
        }
    }
    echo "<h3>==================================================</h3>";
}

function drawTableForFunctions(){
    /*
     * Take up an array of functions and its' names like this:
     *     ( (foo, "foo"), (bar, "bar") )
     */
    echo "<h2>Trigonometric table</h2>";
    echo "<style>table{border: 1px solid #009933; background: #000033; color: #b3b3ff}</style>";
    echo "<style>tr{border: 1px solid #009933;}</style>";
    echo "<style>th{border: 1px solid #009933;}</style>";
    echo "<table>";
    echo "<tr>";
    echo "<th>Deg</th>";
    echo "<th>Rad</th>";
    echo "<th>sin</th>";
    echo "<th>cos</th>";
    echo "<th>tan</th>";
    echo "<th>cotan</th>";
    echo "</tr>";
    for($degree = 0; $degree < 360; $degree++){
        echo "<tr>";
        echo "<th>$degree</th>";
        $rad = deg2rad($degree);
        echo "<th>$rad</th>";
        $sin_v = sin($rad);
        echo "<th>$sin_v</th>";
        $cos_v = cos($rad);
        echo "<th>$cos_v</th>";
        $tan_v = tan($rad);
        echo "<th>$tan_v</th>";
        $cotan_v = fdiv(1, $tan_v);
        echo "<th>$cotan_v</th>";
        echo "</tr>";
    }
    echo "</table>";

}


function main(){
    echo "<style>body{background: #000033; color: #b3b3ff}</style>";
    echo "<body>";
    test_isWierd(1000, 3);
    test_giveChange(20);
    test_validateCardNumber(20);
    drawTableForFunctions();
    echo "</body>";
}
main();
?>