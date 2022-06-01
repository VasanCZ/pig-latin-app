<?php
declare(strict_types=1);

namespace App\MainModule\Model;

class PigLatinManager {

    public function translateToPigLatin(string $inputText): string {

        $outputText = "";
        
        $lowerText = strtolower($inputText);
        $lowerText = trim(preg_replace('/\s+/', ' ', $lowerText)); // Remove more spaces
        $wordArray = explode(" ", $lowerText);
        $wordArray = array_filter($wordArray);
        
        foreach ($wordArray as $word) {
            $outputText .= " ";
            $charArray = str_split($word);          
            $charIndex = 0;

            // I need to practice regular expressions more
            if (preg_match('/[aeiou]/', substr($word, 0, 1))) {
                $outputText .= $word . "-way";
                continue;
            }
            foreach ($charArray as $char) {
                if (preg_match('/[y]/', substr($word, 0, 1))) {
                    $charIndex = strpos($word, $char) + 1;
                    break;
                }
                elseif ((strlen($word) == 2) && (preg_match('/[y]/', substr($word, 1, 1)))){
                    $charIndex = strpos($word, $char) + 1;
                    break;
                }
                elseif (preg_match('/[aeiou]/', $char)){
                    $charIndex = strpos($word, $char);
                    break;
                }
            }
            $outputText .= substr($word, $charIndex) . "-" . substr($word, 0, $charIndex) . "ay";       
        }
        return $outputText;
    }
}