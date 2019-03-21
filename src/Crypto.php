<?php
/**
 * Created by PhpStorm.
 * User: crazy
 * Date: 2019/3/20
 * Time: 13:40
 */

namespace Crazy;

/**
 * 加密解密类
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

    public static function __callStatic($name)
    {
        $class = false !== strpos($name, '\\') ? $name : '\\crazy\\crypto\\lib\\' . ucfirst(strtolower($name));
        if (!self::$instance instanceof $class) {
            self::$instance = new $class();
        }
        return self::$instance;
    }
}
