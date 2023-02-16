<?php 

namespace App\Service;
use Symfony\Component\Serializer\Serializer;

interface SerializerInterface {
    public function serializer(): Serializer;
}