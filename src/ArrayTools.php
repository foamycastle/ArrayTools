<?php

namespace Foamycastle\Tools;

trait ArrayTools
{
    public const FLATTEN_DOTTED='.';
    public const FLATTEN_FW_SLASH='/';
    public const FLATTEN_BK_SLASH='\\';
    protected function arrayFlatten(array $array, array &$output=[], string $parentKey='', string $delimiter=self::FLATTEN_DOTTED):void
    {

        foreach ($array as $key => $value) {
            if(is_array($value)) {
                is_numeric($key)
                    ? $this->arrayFlatten(
                    $value,
                    $output,
                    ($parentKey == '' ? '' : $parentKey),
                    $delimiter
                )
                    : $this->arrayFlatten(
                    $value,
                    $output,
                    ($parentKey == '' ? $key : $parentKey . $delimiter . $key),
                    $delimiter
                    );
            }else{
                is_numeric($key)
                    ? $output[]=($parentKey==''?$value:$parentKey.$delimiter.$value)
                    : $output[]=($parentKey==''?($key.$delimiter.$value):$parentKey.$delimiter.$key.$delimiter.$value);
            }
        }
    }
}