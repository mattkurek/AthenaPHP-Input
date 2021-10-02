<?php

namespace MattKurek\AthenaPHP;

use MattKurek\AthenaPHP\Extract;

$GLOBALS[Input::$GLOBAL_VARIABLE] = false;

class Input
{
    /** 
     *      @var bool the name of the global variable that represents the AthenaPHP Input object
     */
    public static string $GLOBAL_VARIABLE = "___AthenaPHPInput";

    /** 
     *      @var bool if valid json data was recieved it will be here as an associative array, otherwise null if no json data
     */
    public ?array $decodedJson = null;

    /** 
     *      @var bool flag that indicates if input methods have been analyzed yet
     */
    public bool $inputAnalyzed = false;

    /** 
     *      @var string if data exists in the php input buffer it will be written here, otherwise null if no data
     */
    public ?string $rawInput = null;

    /** 
     *      @var bool flag that indicates if GET parameters were recieved
     */
    public bool $receivedGet = false;

    /** 
     *      @var bool flag that indicates if JSON data was recieved
     */
    public bool $receivedJson = false;

    /** 
     *      @var bool flag that indicates if POST data was recieved 
     */
    public bool $receivedPost = false;

    /** 
     * 
     */
    public function __construct()
    {
        try {

            $this->checkInputStream();
        } catch (\Exception $e) {

            // log any unexpected errors and return an error response
            error_log($e);
        }
    }



    /** 
     *      Check's to see if the php input buffer contains data from the client
     * 
     *      @return bool returns true if the client provided data and false if not
     */
    public function checkInputStream(): bool
    {
        try {

            // get the contents of the php input buffer
            $rawInputBuffer = file_get_contents("php://input");

            if ($rawInputBuffer) {
                // if there is in fact data available in the input buffer
                $this->rawInput = $rawInputBuffer;

                $decodedJson = json_decode($rawInputBuffer, TRUE);

                if ($decodedJson == null or empty($decodedJson)) {

                    // if the data couldn't be decoded...then we must have recieved POST data
                    return true;
                } else {

                    // if the data was decoded properly...then we received Json data
                    $this->receivedJson = true;
                    $this->decodedJson = $decodedJson;
                    return true;
                }
            } else {

                // no data available in the input buffer
                return false;
            }
        } catch (\Exception $e) {

            // log any unexpected errors and return an error response
            error_log($e);
        }
    }


    /** 
     *      Check's to see if the client provided any GET parameters with their request
     * 
     *      @return bool returns true if GET parameters exist and false if not
     */
    public static function checkInputInitialized(): void
    {

        if (is_bool($GLOBALS[self::$GLOBAL_VARIABLE])) {
            // if the global variable for running AthenaPHP Input hasn't been intialized, then initiate a new object
            $GLOBALS[self::$GLOBAL_VARIABLE] = new Input();
        }
    }

    /** 
     *      Check's to see if the client provided any GET parameters with their request
     * 
     *      @return bool returns true if GET parameters exist and false if not
     */
    public static function fromGET(string $termName, string $dataType, ?string $errorName = null)
    {

        try {

            // make sure that the AthenaPHP Input global object has been initialized
            self::checkInputInitialized();

            $term = Extract::fromArray($_GET, $termName, $dataType);

            // return the validated term
            return $term;
        } catch (\Exception $e) {

            // log any unexpected errors and return an error response
            error_log($e);
        }
    }

    /** 
     *      Check's to see if the client provided any GET parameters with their request
     * 
     *      @return bool returns true if GET parameters exist and false if not
     */
    public static function fromJSON(string $termName, string $dataType, ?string $errorName = null)
    {

        try {

            // make sure that the AthenaPHP Input global object has been initialized
            self::checkInputInitialized();

            $term = Extract::fromArray(($GLOBALS[self::$GLOBAL_VARIABLE])->decodedJson, $termName, $dataType);

            // return the validated term
            return $term;
        } catch (\Exception $e) {

            // log any unexpected errors and return an error response
            error_log($e);
        }
    }

    /** 
     *      Check's to see if the client provided any GET parameters with their request
     * 
     *      @return bool returns true if GET parameters exist and false if not
     */
    public static function fromPOST(string $termName, string $dataType, ?string $errorName = null)
    {

        try {

            // make sure that the AthenaPHP Input global object has been initialized
            self::checkInputInitialized();

            $term = Extract::fromArray($_POST, $termName, $dataType);

            // return the validated term
            return $term;
        } catch (\Exception $e) {

            // log any unexpected errors and return an error response
            error_log($e);
        }
    }
}
