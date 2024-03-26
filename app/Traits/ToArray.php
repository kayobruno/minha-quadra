<?php

declare(strict_types=1);

namespace App\Traits;

trait ToArray
{
    public function toArray(): array
    {
        $array = get_object_vars($this);
        $snakeCaseArray = [];

        foreach ($array as $key => $value) {
            $snakeCaseKey = $this->convertToSnakeCase($key);
            $snakeCaseArray[$snakeCaseKey] = $value;
        }

        return $snakeCaseArray;
    }

    private function convertToSnakeCase(string $input): string
    {
        $result = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));

        return $result;
    }
}
