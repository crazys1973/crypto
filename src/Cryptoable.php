<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/3/20
 * Time: 14:10
 */

namespace Crazy;


interface Cryptoable
{
    /**
     * 加密字符串
     * @param string  $data   字符串
     * @param string  $key    加密key
     * @param integer $expire 有效期（秒）
     * @return string
     */
    public function encrypt($data, $key, $expire = 0);

    /**
     * 解密字符串
     * @param string $data 字符串
     * @param string $key  加密key
     * @return string
     */
    public function decrypt($data, $key);
}