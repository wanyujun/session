<?php
/**
 * Created by PhpStorm.
 * User: wanyujun
 * Date: 2017/6/6
 * Time: 下午11:34
 */

namespace Session\Driver;


abstract class AbstractDriver
{
    public function open()
    {
        return true;
    }

    public function close()
    {
        return true;
    }

    public function gc()
    {
        
    }
}