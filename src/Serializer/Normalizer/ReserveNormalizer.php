<?php

namespace App\Serializer\Normalizer;

use App\Entity\Reserve;
//use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class ReserveNormalizer implements NormalizerInterface
{
//    use NormalizerAwareTrait;

    public function __construct(
        //private UrlGeneratorInterface $router,
        private ObjectNormalizer $normalizer,
    ) {
    }

    public function normalize($object, string $format = null, array $context = []): array
    {
        $data = $this->normalizer->normalize($object, $format, $context);

        // TODO: add, edit, or delete some data
        // just test if its executing
        $data['id'] = $data['id'].'_hamid';

        return $data;
    }
    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {

        return $data instanceof Reserve;
    }

//    public function getSupportedTypes(?string $format): array
//    {
//        return [
//            Reserve::class => true,
//        ];
//    }


    public function getSupportedTypes(?string $format): array
    {
        return [
            //'object' => null,             // Doesn't support any classes or interfaces
            //'*' => false,                 // Supports any other types, but the result is not cacheable
            Reserve::class => true, // Supports MyCustomClass and result is cacheable
        ];
    }
}
