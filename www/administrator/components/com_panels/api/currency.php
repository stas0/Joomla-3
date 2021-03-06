<?php
    class ExchangeRate {

        // URL, файл в формате XML
        public $exchange_url =
            'http://bank-ua.com/export/currrate.xml';
        public $xml;

        function __construct(){
            // интерпретируем XML-файл в объект
            return $this->xml =
                simplexml_load_file($this->exchange_url);
        }

        function getExchangeRateByChar3($char3){

            if ($this->xml!==FALSE) {
                // все хорошо, можно работать дальше -
                // в XML-данных нет ошибки

                foreach($this->xml->children() as $item){
                    $row = simplexml_load_string($item->asXML());
                    // Выполняем XPath-запрос к XML-данным
                    $v = $row->xpath('//char3[. ="' . $char3 . '"]');

                    if($v[0]){
                        $result = $item;

                        break;
                    }
                }
            }
            return $result;
        }
    }

        ?>