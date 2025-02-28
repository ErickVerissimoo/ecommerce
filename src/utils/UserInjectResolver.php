<?php

namespace App\utils;

use RequestParseBodyException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class UserInjectResolver implements ValueResolverInterface
{
    
    /**
     * @inheritDoc
     */
    public function resolve(Request $request, ArgumentMetadata $argument):iterable{
        $type = $argument->getType();
        
        if(property_exists($type,"user")){

        }




        return [];
    }
}