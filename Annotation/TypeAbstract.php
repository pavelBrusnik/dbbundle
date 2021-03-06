<?php namespace Ewll\DBBundle\Annotation;

abstract class TypeAbstract implements AnnotationInterface
{
    public $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function transformToView($value)
    {
        if (null === $value) {
            return null;
        }

        return $value;
    }

    public function transformToStore($value)
    {
        if (null === $value) {
            return null;
        }

        return $value;
    }
}
