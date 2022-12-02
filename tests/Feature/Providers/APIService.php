<?php

namespace Habibeh92\Converter\Tests\Feature\Providers;


use Habibeh92\Converter\Converter;
use Habibeh92\Converter\Exceptions\AttributeTypeIsNotInstantiable;
use Habibeh92\Converter\Exceptions\AttributeTypeNotDefined;
use Habibeh92\Converter\Exceptions\PropertyTypeNotDefined;
use ReflectionException;

class APIService
{
    /**
     * execute the sample API based on the provider and get the Entity
     *
     * @param APIProvider $provider
     *
     * @return object
     * @throws AttributeTypeIsNotInstantiable
     * @throws AttributeTypeNotDefined
     * @throws PropertyTypeNotDefined
     * @throws ReflectionException
     */
    public function execute(APIProvider $provider): object
    {
        $data = file_get_contents($provider->path());

        return (new Converter($provider->decoder()))->handle($provider->entity(), $data);
    }
}
