<?php

namespace App\DataModel\Manager;

class DataManager
{
    public function toArrayObject($obj)
    {
        $ref = new \ReflectionClass($obj);
        $data = array();
        foreach (array_values($ref->getMethods()) as $method) {
            if ((0 === strpos($method->name, "get")) && $method->isPublic()) {
                $methodExists = new \ReflectionMethod($obj, $method->name);
                $params = $methodExists->getParameters();
                if (count($params) == 0) {
                    $name = substr($method->name, 3);
                    $name[0] = strtolower($name[0]);
                    $value = $method->invoke($obj);
                    if ($value !== null) {
                        if ("object" === gettype($value)) {
                            $value = $this->toArrayObject($value);
                        } else if ("array" === gettype($value)) {
                            $key = array_keys($value);
                            for ($j = 0; $j < count($value); $j++) {
                                if ("object" === gettype($value[$key[$j]])) {
                                    $value[$key[$j]] = $this->toArrayObject($value[$key[$j]]);
                                }
                            }
                        }
                        $data[$name] = $value;
                    }
                }
            }
        }
        return $data;
    }

    public function convertObjectToArray($obj)
    {
        return $this->toArrayObject($obj);
    }

    public function convertObjectListToArrayList($objList)
    {
        $arrayList = array();

        foreach ($objList as $key => $obj) {
            $arrayList[] = $this->toArrayObject($obj);
        }

        return $arrayList;
    }

}
