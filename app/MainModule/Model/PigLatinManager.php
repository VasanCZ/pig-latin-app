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

            if (preg_match('/[aeiouy]/', substr($word, 0, 1))) {
                $outputText .= $word . "-way";
                continue;
            }
            foreach ($charArray as $char) {

                if (preg_match('/[aeiouy]/', $char)){
                    $charIndex = strpos($word, $char);
                    break;
                }
            }
            $outputText .= substr($word, $charIndex) . "-" . substr($word, 0, $charIndex) . "ay";       
        }
        return $outputText;
    }
}