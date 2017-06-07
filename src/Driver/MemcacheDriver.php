<?php
/**
 * Created by PhpStorm.
 * User: laowan
 * Date: 2017/6/8
 * Time: 上午12:35
 */

namespace Session\Driver;


class MemcacheDriver extends AbstractDriver
{

    private $_config = null;

    private $_memcache = null;


    public function __construct($config)
    {
        if (empty($config['prefix'])) $config['prefix'] = null;
        $this->_config = $config;

        try {
            $this->_memcached = new \Memcache();
            $this->_memcache->connect($this->_config['host'], $this->_config['port'], $this->_config['timeout']);
        } catch (\MemcachedException $e) {
            $e->getMessage();
        }
    }

    public function read($session_id)
    {
        return $this->_memcache->get($this->_config['prefix'] . $session_id);
    }

    public function write($session_id, $session_data)
    {
        return $this->_memcache->set($this->_config['prefix'] . $session_id, $session_data, $this->_config['expire']);
    }

    public function destroy($session_id)
    {
        $this->_memcache->delete($this->_config['prefix'] . $session_id);
        return true;
    }
}