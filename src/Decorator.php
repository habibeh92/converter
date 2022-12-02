<?php


namespace Habibeh92\Converter;

use Habibeh92\Converter\Exceptions\AttributeTypeIsNotInstantiable;
use Habibeh92\Converter\Exceptions\AttributeTypeNotDefined;
use Habibeh92\Converter\Exceptions\PropertyTypeNotDefined;
use Exception;
use Habibeh92\Converter\Attributes\DataType;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

/**
 * Class Decorator.
 */
class Decorator
{
    /**
     * decode the data
     *
     * @param object $entity
     * @param array  $data
     *
     * @return object
     * @throws AttributeTypeIsNotInstantiable
     * @throws AttributeTypeNotDefined
     * @throws PropertyTypeNotDefined
     * @throws ReflectionException
     */
    public static function handle(object $entity, array $data): object
    {
        // get the reflection class of the entity
        $reflection_class = new ReflectionClass($entity);
        foreach ($reflection_class->getProperties() as $property) {
            // get the available attributes
            foreach ($property->getAttributes(DataType::class) as $attribute) {
                $attribute_instance = $attribute->newInstance();
                $property_type      = $property->getType();

                if (!$property_type) {
                    throw new PropertyTypeNotDefined("Property type is not defined");
                }

                if (!isset($data[$attribute_instance->field])) {
                    continue;
                }

                // decode recursively the array data types
                if ($property_type->getName() == "array" and is_array($data[$attribute_instance->field])) {
                    $entity = static::handleArray($entity, $property, $attribute_instance, $data);

                    continue;
                }

                // set data field to the entity property
                $entity->{$property->name} = static::cast($data[$attribute_instance->field], $property_type->getName());
            }
        }

        return $entity;
    }



    /**
     * decorate array types
     *
     * @param object             $entity
     * @param ReflectionProperty $property
     * @param                    $attribute_instance
     * @param array              $data
     *
     * @return object
     * @throws AttributeTypeIsNotInstantiable
     * @throws AttributeTypeNotDefined
     * @throws PropertyTypeNotDefined
     * @throws ReflectionException
     */
    private static function handleArray(object $entity,ReflectionProperty $property, $attribute_instance, array $data): object
    {
        if (is_null($attribute_instance->type)) {
            throw new AttributeTypeNotDefined("DataType attribute for entity property is not defined.");
        }

        foreach ($data[$attribute_instance->field] as $item) {
            try {
                $object = new ReflectionClass($attribute_instance->type);
            } catch (Exception $exception) {
                throw new AttributeTypeIsNotInstantiable("Attribute type should be instantiable");
            }

            if ($object->isInstantiable()) {
                $entity->{$property->name}[] = static::handle($object->newInstance(), $item);
            }
        }
        return $entity;
    }



    /**
     * cast the field to a valid data-type based on the property type
     *
     * @param mixed  $field
     * @param string $property_type
     *
     * @return bool|float|int|string
     */
    private static function cast(mixed $field, string $property_type): float|bool|int|string
    {
        return match ($property_type) {
            'string' => (string)$field,
            'int' => (int)$field,
            'bool' => (bool)$field,
            'float' => (float)$field,
            default => $field,
        };
    }

}
