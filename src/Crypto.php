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

/**
 * 加密解密类
 * @method lib\Aes Aes() static AES-256-CBC 加密实现类
 * @method lib\Base64 Base64() static Base64 加密实现类
 * @method lib\Crypt Crypt() static Crypt 加密实现类
 * @method lib\Des Des() static Des 加密实现类
 * @method lib\Think Think() static Think 加密实现类
 * @method lib\Xxtea Xxtea() static Xxtea 加密实现类
 * @package crazy\crypt
 */
class Crypto
{
    private static $instance;

    public static function __callStatic($name, $arguments)
    {
        $class = false !== strpos($name, '\\') ? $name : '\\Crazy\\lib\\' . ucfirst(strtolower($name));
        class_exists($class) or $class = '\Crazy\lib\Think';

        if (!self::$instance instanceof $class) {
            self::$instance = new $class();
        }
        return self::$instance;
    }

    private function __construct()
    {
    }
}
