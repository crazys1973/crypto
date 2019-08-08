<?php
/**
 * Crazy/crypto
 * 统一加密/解密工具类
 *
 * Author：惠达浪
 * Blog: https://www.qdcrazy.cc
 * Email： crazys@126.com
 * Date：  2019/03/20
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