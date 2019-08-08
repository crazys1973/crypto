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

namespace Crazy\lib;

use Crazy\Cryptoable;

/**
 * Crypt 加密实现类
 * @category    ORG
 * @package     ORG
 * @subpackage  Crypt
 * @author      liu21st <liu21st@gmail.com>
 */
class Crypt implements Cryptoable
{

    /**
     * 加密字符串
     * @param string  $data   字符串
     * @param string  $key    加密key
     * @param integer $expire 有效期（秒）
     * @return string
     */
    public function encrypt($data, $key, $expire = 0)
    {
        $expire = sprintf('%010d', $expire ? $expire + time() : 0);
        $r      = md5($key);
        $c      = 0;
        $v      = "";
        $data   = $expire . $data;
        $len    = strlen($data);
        $l      = strlen($r);
        for ($i = 0; $i < $len; $i++) {
            if ($c == $l) $c = 0;
            $v .= substr($r, $c, 1) .
                (substr($data, $i, 1) ^ substr($r, $c, 1));
            $c++;
        }
        return self::ed($v, $key);
    }

    /**
     * 解密字符串
     * @param string $data 字符串
     * @param string $key  加密key
     * @return string
     */
    public function decrypt($data, $key)
    {
        $data = self::ed($data, $key);
        $v    = "";
        $len  = strlen($data);
        for ($i = 0; $i < $len; $i++) {
            $md5 = substr($data, $i, 1);
            $i++;
            $v .= (substr($data, $i, 1) ^ $md5);
        }
        $ret    = $v;
        $expire = substr($ret, 0, 10);
        if ($expire > 0 && $expire < time()) {
            return '';
        }
        $ret = substr($ret, 10);
        return $ret;
    }


    private function ed($str, $key)
    {
        $r   = md5($key);
        $c   = 0;
        $v   = '';
        $len = strlen($str);
        $l   = strlen($r);
        for ($i = 0; $i < $len; $i++) {
            if ($c == $l) $c = 0;
            $v .= substr($str, $i, 1) ^ substr($r, $c, 1);
            $c++;
        }
        return $v;
    }
}