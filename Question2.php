<?php

$input = <<<EOF
ababaa
aa
123123
aaab
EOF;

echo challenge2($input);


/**
 * @param $linesOfCases
 * @return string
 */
function challenge2($linesOfCases){
    $cases = explode("\n", $linesOfCases);
    $cases = array_map('trim', $cases);
    $output="";
    foreach ($cases as $case)
        $output .= calcSuffix($case,$case) . "\n";

    return nl2br($output);
}


/**
 * @param $str1 : first String
 * @param $str2 : second String
 * @return int  : return similarity of two params Strings
 */
function calcSim($str1, $str2){
    if($str1==$str2) return strlen($str2);
    $lenStr1 = strlen($str1);
    $lenStr2 = strlen($str2);

    $maxToMatch = ( $lenStr1 > $lenStr2 ) ? $lenStr2 : $lenStr1;
    $matchingCount = 0;
    $str1Arr = str_split($str1);
    $str2Arr = str_split($str2);

    for($i=0; $i < $maxToMatch; $i++){
        if($str1Arr[$i] == $str2Arr[$i])
            $matchingCount++;
        else
            break;
    }
    return $matchingCount;
}

/**
 * @param $orgStr
 * @param $sfxStr
 * @return int
 */
function calcSuffix($orgStr, $sfxStr){
   if(!$sfxStr) return 0;
    $lenOrg = strlen($orgStr);
    $lenSfx = strlen($sfxStr);
    $calcSim = calcSim($orgStr,substr($orgStr,$lenOrg-$lenSfx));
    return $calcSim + calcSuffix($orgStr,substr($orgStr,$lenOrg-$lenSfx+1));
}