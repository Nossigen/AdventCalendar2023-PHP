<?php

class NumberNormalizer {
    private const NUMBERS = [
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
        for ($i = 0; $i <= strlen($line); $i++) {
            // Récupération des i premières lettres.
            $current_line_part = substr($line, 0, $i);

            // On remplace pour les i premières lettres les nombre au format texte par des vrais nombre
            $normalized_current_line_part = str_replace(
                array_keys(self::NUMBERS),
                array_values(self::NUMBERS),
                $current_line_part
            );

            // Si les la versions avec remplacement ne correspond pas à la version d'origine, 
            // alors un remplacement a eu lieu, on le sauvegarde et on recommence depuis le début
            if ($current_line_part !== $normalized_current_line_part) {
                $line = str_replace($current_line_part, $normalized_current_line_part, $line);
                $i = 0;
            }
        }

        // Récupération des nombres
        $numbers = preg_replace("/[^0-9]+/", "", $line);
        return $numbers;    
    }
}
