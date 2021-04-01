<?php
class Base_Model extends Model
{
    /* User Defined Methods */


    /* Special Functions */

    /**
     * URL Cipher: decode n encode
     * $_string: String Input Required     
     * $reverse_function: true for reversing functionality
     * $_pattern: Pattern to be searched
     * $_multiplier: New Pattern to be sent
     * @version 0.1.3
     * @since 05-03-2021 12:09pm      
     * @uses str_replace(), Base_Model@cipher()
     */
    public function url_cipher($_string, $reverse_function = false, $_pattern = ' ', $_multiplier = '_')
    {
        if ($reverse_function === true)
            return str_replace($_multiplier, $_pattern, $this->cipher($_string, $reverse_function));
        return $this->cipher(str_replace($_pattern, $_multiplier, $_string), $reverse_function);
    }


    /**
     * Json: decode n encode
     * $collection: Array or String Input Required     
     * $reverse_function: true for reversing functionality
     * @version 0.1.2
     * @since 05-03-2021 12:09pm 
     * @uses json_encode(), json_decode(), Base_Model@cipher()     
     */
    public function _json($collection, $reverse_function = false)
    {
        if ($reverse_function === false) {
            if (!is_array($collection))
                return $collection;
            return $this->cipher(json_encode($collection));
        } else {
            if (is_array($collection))
                return $collection;
            return (array)json_decode($this->cipher($collection, true));
        }
    }

    /**
     * Cipher: Enceryption n Decryption
     * $collection: Array or String Input Required
     * $key: Required for Array
     * $reverse_function: true for reversing functionality
     * @version 0.1.3
     * @since 05-03-2021 12:09pm
     * @uses Base_Model@_cipher()
     */
    public function cipher($collection, $key = false, $reverse_function = false)
    {
        if (is_array($collection)) {
            if (is_array($key)) {
                foreach ($key as $_key)
                    $collection[$_key] = $this->_cipher($collection[$_key], $reverse_function);
                return $collection;
            } else {
                return $this->_cipher((array)$collection[$key], $reverse_function);
            }
        } else {
            return $this->_cipher($collection, $key);
        }
    }

    /**
     * _cipher
     * Helper Function
     * @version 0.1.5
     * @uses ctype_xdigit(), bin2hex(), hex2bin()
     */
    private function _cipher($__txt, $__process = false)
    {
        if ($__process === false) {
            if (ctype_xdigit($__txt))
                return $__txt;
            return bin2hex($__txt);
        } else {
            if (!ctype_xdigit($__txt) || strlen($__txt) % 2 != 0)
                return $__txt;
            return hex2bin($__txt);
        }
    }

    /**
     * crypt: helper function
     * @version 0.1.6
     * @uses crypt()
     * @todo Define function properly
     */
    private function crypt($__txt, $__salt = CRYPT_SHA512)
    {
        return crypt($__txt, $__salt);
    }
}
