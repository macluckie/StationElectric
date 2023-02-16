<?php

namespace App\Domain\Station;

class DataCollection
{
    public int $creat_at;
    public string $default_sorting_field;
    public array $fields;
    public string $name;
    public int $num_documents;
    public array $symbols_to_index;
    public array $token_separators;
}
