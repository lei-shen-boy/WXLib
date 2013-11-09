<?php 
namespace WXLib\Tool;

class DataParser
{
    /**
     * Convert a array to json string
     * @param array $data
     * @return string
     */
    static function toJson($data)
    {
        return json_encode($data);
    }
    
    /**
     * Parse a json string to arry
     * @param string $json
     * @return mixed
     */
    static function parseJson($json)
    {
        return json_decode($json, true);
    }
    
    /**
     * Parse a xml string to array
     * @param string $xml
     * @return array
     */
    static function parseXml($xml)
    {
        return (array)simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
    }
    
    
}
?>