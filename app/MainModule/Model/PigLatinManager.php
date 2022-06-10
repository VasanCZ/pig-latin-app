<?php
declare(strict_types=1);

namespace App\MainModule\Model;

class PigLatinManager {

    public function translateToPigLatin(string $inputText): string {

        $outputText = "";
        $wordArray = $this->prepareText($inputText);
        
        foreach ($wordArray as $word) {
            $outputText .= " ";
            $charArray = str_split($word);          
            $charIndex = 0;

            // I need to practice regular expressions more
            if ($this->isFirstVowel($word)) {
                $outputText .= $word . "-way";
                continue;
            }
            foreach ($charArray as $char) {
                if ($this->isFirstY($word)) {
                    $charIndex = strpos($word, $char) + 1;
                    break;
                }
                elseif ($this->isLikeWordMy($word)){
                    $charIndex = strpos($word, $char) + 1;
                    break;
                }
                elseif ($this->isMatchVowel($char)){
                    $charIndex = strpos($word, $char);
                    break;
                }
            }
            $outputText .= substr($word, $charIndex) . "-" . substr($word, 0, $charIndex) . "ay";       
        }
        return $outputText;
    }

    private function prepareText(string $text): array {
        $lowerText = strtolower($text);
        $lowerText = trim(preg_replace('/\s+/', ' ', $lowerText)); // Remove more spaces
        $lowerText = trim(preg_replace('/[.,!?]/', '', $lowerText));
        $wordArray = explode(" ", $lowerText);
        $wordArray = array_filter($wordArray);
        return $wordArray;
    }

    private function isFirstVowel(string $word): bool {
        return (bool) preg_match('/[aeiou]/', substr($word, 0, 1));
    }

    private function isFirstY(string $word): bool {
        return (bool) preg_match('/[y]/', substr($word, 0, 1));
    }

    private function isLikeWordMy(string $word): bool {
        return (bool) (strlen($word) == 2) && (preg_match('/[y]/', substr($word, 1, 1)));
    }

    private function isMatchVowel(string $char): bool {
        return (bool) preg_match('/[aeiou]/', $char);
    }
}