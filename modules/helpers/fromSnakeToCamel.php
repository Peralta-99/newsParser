<?php

namespace Modules\helpers;

use Illuminate\Support\Str;

trait fromSnakeToCamel {

    public function __get($key)
    {
        foreach ($this->attributes as $columnKey => $value) {
            $methodName = Str::camel('get_' . $key) . 'Attribute';
            if ($key === Str::camel($columnKey)) {
                $method = (function() use ($columnKey)
                {
                    return $this->attributes[$columnKey];
                })();
                return $this->{$methodName} = $method;
            } else {
                continue;
            }
        }

        return parent::__get($key);
    }

}
