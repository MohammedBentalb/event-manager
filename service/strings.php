<?php 

namespace Service;

class Strings {
    public function toSnakeCase($word){
        return strtolower(
            preg_replace('/(?<!^)[A-Z]/', '_$0', $word)
        );
    }
    function toCamelCase(string $input, bool $capitalizeFirst = false): string {
        $str = str_replace('_', ' ', strtolower($input));
        $str = ucwords($str);
        $str = str_replace(' ', '', $str);

        return $capitalizeFirst ? $str : lcfirst($str);
    }
}