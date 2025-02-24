<?php

namespace App\Dto;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsTargetedValueResolver;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\SerializerInterface;
#[AsTargetedValueResolver]
class UserRequestResolver implements ValueResolverInterface
{
   public function __construct(private SerializerInterface $serializer) {} 
    /**
     * @inheritDoc
     */
    public function resolve(Request $request,ArgumentMetadata $argument):iterable {
   $entity = $this->serializer->deserialize($request->getContent(), UserRequestDto::class,'json');
   yield $entity;
    }
}