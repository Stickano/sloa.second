<?php

class ArrayHandler{

    public function __construct(){
    }

    /**
     * Reads through an array and returns the output nicely
     * @param  array  $array The array to iterate through
     * @return [type]        [description]
     */
    public function read(array $array){
        $it = new RecursiveIteratorIterator(new RecursiveArrayIterator($array));
        return '<pre>'.var_dump($it->getArrayCopy()).'</pre>';
    }

    /**
     * Searches an multidimensional array
     * Thx to https://stackoverflow.com/a/1019126
     * @param  array $array  an array of arrays
     * @param  string $key   which key to search for
     * @param  string $value which value the key should have
     * @return array         an array of result (multi)
     */
    public function search(array $array, $key, $value){
        $result = array();
        self::search_r($array, $key, $value, $result);
        return $result;
    }

    private function search_r($array, $key, $value, &$result){
        if (!is_array($array))
            return;

        if (isset($array[$key]) && $array[$key] == $value)
            $result[] = $array;

        foreach ($array as $sub) {
            self::search_r($sub, $key, $value, $result);
        }
    }
}

?>
