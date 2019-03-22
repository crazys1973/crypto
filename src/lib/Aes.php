<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/3/22
 * Time: 9:27
 */

namespace Crazy\lib;


use Crazy\Cryptoable;

class Aes implements Cryptoable
{
    private $hex_iv = 'ff6ef4feaa3146f8c488ac637b8ebfe9';
    private $algorithm = 'AES-256-CBC';

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
        $key = hash('sha256', $key, true);
        $data = $expire . $data;

        $enString = openssl_encrypt($data, $this->algorithm, $key, OPENSSL_RAW_DATA, $this->hexToStr($this->hex_iv));
        return base64_encode($enString);
    }

    /**
     * 解密字符串
     * @param string $data 字符串
     * @param string $key  加密key
     * @return string
     */
    public function decrypt($data, $key)
    {
        if (empty($data)) {
            return '';
        }

        $key = hash('sha256', $key, true);

        $decrypted = openssl_decrypt(base64_decode($data), $this->algorithm, $key, OPENSSL_RAW_DATA, $this->hexToStr($this->hex_iv));
        if ($decrypted === false) {
            return '';
        }
        $expire = substr($decrypted, 0, 10);
        if ($expire > 0 && $expire < time()) {
            return '';
        }
        return substr($decrypted, 10);
    }

    private function hexToStr($hex)
    {
        $string = '';
        for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
            $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
        }
        return $string;
    }
}