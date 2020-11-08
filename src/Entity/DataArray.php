<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 04.11.18
 * Time: 19:18
 */
namespace App\Entity;

class DataArray
{
    /**
     * @param array|null  $data
     * @param string|null $key
     * @param null        $defaultEmptyReturn
     * @return array|mixed|null
     */
    public static function getDataArray(?array $data, ?string $key, $defaultEmptyReturn = null)
    {

        if ($key != null && $data != null && is_array($data) && !empty($data)) {
            $keys = explode('.', $key);
            $value_temp = $data;
            foreach ($keys as $key_t) {
                if (array_key_exists($key_t, $value_temp)) {
                    $value_temp = $value_temp[$key_t];
                } else {
                    return $defaultEmptyReturn;
                }
            }
            if (is_string($value_temp) && $value_temp == "null") {
                return null;
            } else {
                return $value_temp;
            }
        } else {
            return $data ?: $defaultEmptyReturn;
        }
    }

    public static function setDataArray(&$data, ?string $key, $value)
    {

        if ($key != null) {
            $keys = explode('.', $key);

            $value_data = &$data;
            if ($value_data == null) {
                $value_data = [];
            }
            $value_data = &$data;

            foreach ($keys as $key_t) {
                if (!isset($value_data[$key_t])) {
                    $value_data[$key_t] = [];
                }
                $value_data = &$value_data[$key_t];
            }
            $value_data = $value;
        } else {
            $data = array_merge($data, $value ?: []);
        }
    }
}
