<?php

namespace MattKurek\AthenaPHP;

use MattKurek\AthenaPHP\Validate;

class Extract
{

    /** 
     *      @param array 
     *      @param string 
     *      @param string 
     *      @param string 
     * 
     *      @return mixed 
     */
    public static function fromArray(array $targetArray, string $termName, string $dataType, ?string $errorName = null) {

        if (!array_key_exists($termName, $targetArray)) {

        }

        $term = Validate::isType($targetArray[$termName], $dataType);

        return $term;

    }

    /** 
     *      @param object 
     *      @param string 
     *      @param string 
     *      @param string 
     * 
     *      @return mixed 
     */
    public static function fromObject(object $targetObject, string $propertyName, string $dataType, ?string $errorName = null) {

        if (!property_exists($targetObject, $propertyName)) {

        }

        $term = Validate::isType($targetObject->$propertyName, $dataType);

        return $term;

    }

}