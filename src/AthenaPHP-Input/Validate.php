<?php

namespace MattKurek\AthenaPHP;

class Validate
{

    /** 
     *      Description goes here...
     *  
     *      @param array 
     * 
     *      @return mixed 
     */
    public static function isArray($array)
    {

        try {

            // check if array and return if so
            if (is_array($array)) {
                return $array;
            } else {
                return false;
            }
        } catch (\Exception $e) {

            // log any unexpected errors and set an error response
            error_log($e);
        }
    }

    /** 
     *      Description goes here...
     *  
     *      @param array 
     * 
     *      @return mixed 
     */
    public static function isBool($boolean)
    {

        if (is_bool($boolean)) {
            return $boolean;
        } else {
            $converted = boolval($boolean);
            if (is_bool($converted)) {
                return $converted;
            } else {
                return null;
            }
        }
        return null;
    }


    /** 
     *      Description goes here...
     *  
     *      @param array 
     * 
     *      @return mixed 
     */
    public static function isEmail($email)
    {

        try {

            // Removing the illegal characters
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);

            // Validating
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                return ($email);
            } else {
                return false;
            }
        } catch (\Exception $e) {

            // log any unexpected errors and set an error response
            error_log($e);
        }
    }

    /** 
     *      Description goes here...
     *  
     *      @param array 
     * 
     *      @return mixed 
     */
    public static function isFloat($float_number)
    {

        try {

            // make sure its a valid number
            if (!filter_var($float_number, FILTER_VALIDATE_FLOAT) === false) {
                return ($float_number);
            } else {
                return false;
            }
        } catch (\Exception $e) {

            // log any unexpected errors and set an error response
            error_log($e);
        }
    }

    /** 
     *      Description goes here...
     *  
     *      @param array 
     * 
     *      @return mixed 
     */
    public static function isInt($int_number)
    {

        try {

            // make sure its a valid number
            if (!filter_var($int_number, FILTER_VALIDATE_INT) === false) {
                return ($int_number);
            } else {
                // count 0 as a valid integer
                if ($int_number == "0" || $int_number == 0) {
                    return $int_number;
                } else {
                    return false;
                }
            }
        } catch (\Exception $e) {

            // log any unexpected errors and set an error response
            error_log($e);
        }
    }

    /** 
     *      Description goes here...
     *  
     *      @param array 
     * 
     *      @return mixed 
     */
    public static function isIPAddress($ip_address)
    {

        try {

            // make sure its a valid ip address
            if (!filter_var($ip_address, FILTER_VALIDATE_IP) === false) {
                return ($ip_address);
            } else {
                return false;
            }
        } catch (\Exception $e) {

            // log any unexpected errors and set an error response
            error_log($e);
        }
    }


    /** 
     *      Description goes here...
     *  
     *      @param array 
     * 
     *      @return mixed 
     */
    public static function isString($string)
    {

        try {

            // sanitize the text and return it
            $string = filter_var($string, FILTER_SANITIZE_STRING);
            return ($string);
        } catch (\Exception $e) {

            // log any unexpected errors and set an error response
            error_log($e);
        }
    }

    /** 
     *      Description goes here...
     *  
     *      @param array 
     * 
     *      @return mixed 
     */
    public static function isURL($url)
    {

        try {

            // sanitize the url
            $url = filter_var($url, FILTER_SANITIZE_URL);

            // then make sure the url is valid
            if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
                return ($url);
            } else {
                return false;
            }
        } catch (\Exception $e) {

            // log any unexpected errors and set an error response
            error_log($e);
        }
    }

    /** 
     *      Description goes here...
     *  
     *      @param array 
     * 
     *      @return mixed 
     */
    public static function isType($term, string $dataType, ?string $errorName = null)
    {

        switch ($dataType) {
            case ('array'):
                return self::isArray($term);
            case ('bool'):
                return self::isBool($term);
            case ('email'):
                return self::isEmail($term);
            case ('float'):
                return self::isFloat($term);
            case ('int'):
                return self::isInt($term);
            case ('ip'):
                return self::isIPAddress($term);
            case ('skip'):
                return $term;
            case ('string'):
                return self::isString($term);
            case ('url'):
                return self::isURL($term);
            default:
                // ERROR MESSAGE HERE
                return $term;
                break;
        }
    }
}
