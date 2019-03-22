# Crazy/crypto
[![PHP Version](https://img.shields.io/badge/php-%3E%3D5.6-8892BF.svg)](http://www.php.net/)
[![Latest Stable Version](https://poser.pugx.org/crazy/crypto/v/stable)](https://packagist.org/packages/crazy/crypto)
[![License](https://poser.pugx.org/crazy/crypto/license)](https://packagist.org/packages/crazy/crypto)
[![Total Downloads](https://poser.pugx.org/crazy/crypto/downloads)](https://packagist.org/packages/crazy/crypto)

## 简介
由于PHP开发过程中，经常需要对信息进行可逆加解密，本人将ThinkPHP 3.x中的加解密类进行了重新封闭，统一处理。本版中支持6种算法：`AES`、`Base64`、`Crypt`、`Des`、`Think`和`Xxtea`。

---
## 安装
### Git
地址：`https://github.com/crazys1973/crypto.git`
### Composer
命令：`composer require crazy/crypto`
### 系统需求
PHP版本5.6以上

---
## 使用方法
#### 加密
```
Crypto::{加密算法}()->encrypt(string $data, string $key[, int $expire = 0]);
```
返回：加密过后的字符串。
- {加密算法}：加密算法类的名称，目前支持 6 种，分别是：`AES`、`Base64`、`Crypt`、`Des`、`Think`和`Xxtea`。算法名大小写不敏感，Base64与bAsE64效果相同。如果算法名写错，则默认使用Think算法。
- $data：需要加密的字符串。
- $key：加密key，参与加密运算的字符串。
- $expire：有效期，单位为秒

例：  
 ```php
 // 使用Base64算法加密
 $encryptString = Crypto::Base64()->encrypt('Hello world!', 'key123');
 
 // 使用ThinkPHP算法加密
 $encryptString = Crypto::Think()->encrypt('Hello world!', 'key123');
 ```

#### 解密
```php
Crypto::{加密算法}()->decrypt(string $data, string $key);
```
返回：解密成功时返回解密字符串。解密失败或加密串过期，返回空字符串`''`。如果算法名写错，则默认使用Think算法。
- {加密算法}：与加密时的算法名必须相同。
- $data：需要解密的字符串。
- $key：加密时使用的加密key。

例：
```php
// 使用Think算法解密
$data = 'sXym2IR3c62yeqbagn6ZosOq29p_rZTZnNGqoX20c3A';
echo Crypto::Base64()->decrypt($data, 'key123');

// 输出：Hello World!
```

---
##版本更新
#### 1.2.0
- 新增AES加密算法。
- 修改所有数组为短语法。

#### 1.1.1
- 修复加密算法法不存在时报错，更改默认为Think加密方法，例：`Crypto::abc();`将会使用Think加解密算法。
- 添加类注释，方便IDE工具提示。

#### 1.1.0
- 新增Crypto类，集中统一管理加密类
- 新增Cryptoable接口
- 去除加密类的静态方法
- 类使用单例模式

#### 1.0.0
- 集成5种加密算法：Base64, Crypt, Des, Think, Xxtea。
- 修改源码中变量未初始化的bug。
- 更新代码注释。