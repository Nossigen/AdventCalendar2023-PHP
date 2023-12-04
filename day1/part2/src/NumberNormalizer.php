<?php

class NumberNormalizer {
    public const NUMBERS = [
         'one' => '1',
         'two' => '2',
         'three' => '3',
         'four' => '4',
         'five' => '5',
         'six' => '6',
         'seven' => '7',
         'eight' => '8',
         'nine' => '9',
    ];

    public static function normalize_line(string $line): string {
        $result = [];
        $numbers = self::NUMBERS;

        // Récupération des nombres au format textuel
        foreach (array_keys(self::NUMBERS) as $stringified_number) {
            $strposes = self::all_strpos($line, $stringified_number);

            // Conversions des nombres au format textuel en nombre
            $strposes = array_map(static function($value) use ($numbers) {
                return $numbers[$value];
            }, $strposes);

            $result = self::array_indexed_merge($result, $strposes);
        }

        foreach (array_values(self::NUMBERS) as $number) {
            $strposes = self::all_strpos($line, $number);
            $result = self::array_indexed_merge($result, $strposes);
        }

        // Ordonne les résultats en fonction de leur position dans la chaine
        ksort($result);
        return implode('', $result);    
    }

    /**
     * Retourne toutes les positions de $needle dans $haystack sous le format suivant :
     * Clef : Position dans la haystack (Indexé à 0)
     * Valeur : $needle
    */
    private static function all_strpos(string $haystack, string $needle): array {
        $haystack_len = strlen($haystack);
        $result = [];
        $offset = 0;

        do {
            $is_found = strpos($haystack, $needle, $offset);

            if ($is_found !== false) {
                $offset = $is_found;                    
                $result[$offset] = $needle;
                $offset++;
            }

            // Si l'offset dépasse la longueur de la ligne, il n'y a plus rien à trouver
            if ($offset > $haystack_len) {
                $is_found = false;
            }
        } while ($is_found !== false);

        return $result;        
    }


    /**
     * @desc Fusion entre le array1 et array2 tout en gardant l'index de array2
    */
    private static function array_indexed_merge(array $array1, array $array2): array {
        // Fusion entre le tableau de strpos et le tableaux de resultat final tout en gardant l'index
        foreach ($array2 as $index => $value) {
            $array1[$index] = $value;
        }
        return $array1;
    }
}
