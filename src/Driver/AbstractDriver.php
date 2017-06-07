<?php
/**
 * Created by PhpStorm.
 * User: wanyujun
 * Date: 2017/6/6
 * Time: 下午11:34
 */

namespace Session\Driver;

abstract class AbstractDriver implements \SessionHandlerInterface
{

    public function gc($maxlifetime)
    {
        return true;
    }


    public function open($save_path, $session_id)
    {
        return true;
    }

    public function close()
    {
        return true;
    }

    
}