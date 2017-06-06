<?php

/**
 * Created by PhpStorm.
 * User: wanyujun
 * Date: 2017/6/6
 * Time: 下午9:11
 */

namespace Session\Driver;

use \Session\Driver\AbstractDriver;

class RedisDriver extends AbstractDriver implements \SessionHandlerInterface
{
    private $_redis = null;

    private $_config = null;

    public function __construct($config)
    {
        $this->_config = $config;
        try {

            $this->_redis = new \Redis();
            $this->_redis->connect($this->_config['server'], $this->_config['port'], $this->_config['timeout']);
            if (!empty($this->_config['password'])) {
                $this->_redis->auth($this->_config['password']);
            }

        } catch (\SessionException\RedisException $e) {
            $e->show();
        }
    }

    public function destroy($session_id)
    {
        $this->_redis->delete($this->_config['prefix'] . $session_id);
    }

    
    public function read($session_id)
    {
        return $this->_redis->get($this->_config['prefix'] . $session_id);
    }

   
    public function write($session_id, $session_data)
    {
        return $this->_redis->set($this->_config['prefix'] . $session_id, $session_data, $this->_config['exprice']);
    }
}