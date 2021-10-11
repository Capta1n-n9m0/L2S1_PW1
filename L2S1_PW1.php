<?php

header('Content-Type: application/json; charset=utf-8');

function obj31($num){
    $digits = str_split("$num");
    $sum = 0;
    foreach (($digits) as $digit){
        $sum += pow($digit, 3);
    }
    return $sum == $num;
}

function get_obj31(): array{
    $res = array();
    for($ii = 1; $ii < 10; $ii++){
        for($jj = 1; $jj < 10; $jj++){
            for($kk = 1; $kk < 10; $kk++){
                if(obj31("$ii$jj$kk")){
                    array_push($res, "$ii$jj$kk");
                }
            }
        }
    }
    return $res;
}

function obj32($number): array{
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

function get_obj32(): array{
    $n = random_int(0, 10000);
    $change = obj32($n);
    return array($n, $change);
}

function obj33($card_str){
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

function get_obj33(){
    while (true){
        $len = random_int(15,16);
        $cardNumber = randomCardNumber($len);
        if(obj33($cardNumber)){
            return array($cardNumber);
        }
    }
}

function obj4(){
    $res = array();
    for($degree = 0; $degree < 360; $degree++){
        $rad_t = deg2rad($degree);
        $rad_v = "$rad_t";
        $sin_t = sin($rad_t);
        $sin_v = "$sin_t";
        $con_t = cos($rad_t);
        $cos_v = "$con_t";
        $tan_t = tan($rad_t);
        $tan_v = "$rad_t";
        $cotan_t = fdiv(1, $tan_v);
        $cotan_v = "$cotan_t";
        array_push($res, array($rad_v, $sin_v, $cos_v, $tan_v, $cotan_v));
    }
    return $res;
}

function get_obj4($chunk){
    /* it will chop 360 element into 10 groups of 36
     * and then send each one of them
     * */
    return array_slice(obj4(), $chunk*36, 36);
}

switch ($_GET['obj']){
    case 31:
        echo json_encode(get_obj31());
        break;
    case 32:
        echo json_encode(get_obj32());
        break;
    case 33:
        echo json_encode(get_obj33());
        break;
    case 4:
        echo json_encode(obj4());
        break;
    default:
        echo json_encode(array("None"));
}

?>
