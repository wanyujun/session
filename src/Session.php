<?php

/**
 * Created by PhpStorm.
 * User: wanyujun
 * Date: 2017/6/6
 * Time: 下午9:11
 */
namespace  Session;

class Session
{
    private static $_config = null;

    private function __construct($config)
    {

    }

    public function init($config)
    {
        $this->_config = $config;
        $driver = 'Session\\Driver\\' . ucfirst($this->_config['driver']) . 'Driver';
        if (!class_exists($driver)) {  //判断驱动是否存在
            throw new \SessionException\RedisException("不存在该Session驱动");
        }

        //判断是否实现了SessionHandlerInterface接口
        $reflect = new \ReflectionClass($driver);
        if (!$reflect->implementsInterface('SessionHandlerInterface')) {
            throw new \SessionException\DriverException('驱动未能正确加载');
        }
        //注册hanndler类
        session_set_save_handler((new $driver($config)), true);
    }
}