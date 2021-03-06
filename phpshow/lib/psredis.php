<?php
/**
 * redis缓存使用
 * Created by PhpStorm.
 * User: shengsheng
 * Date: 2018/7/19
 * Time: 上午12:44
 */

namespace phpshow\lib;


class psredis
{
    public static $hand_ob = null;

    public static function handle()
    {
        if(self::$hand_ob == null)
        {
            $redis = new \Redis();
            //config文件夹读取 不连接会出现Redis server went away
            $config = \App::getConfig("db")['redis'];
            $redis->connect($config['host'], $config['port']);
            if(!empty($config['auth']))
            {
                $redis->auth($config['auth']);
            }
            self::$hand_ob = $redis;
        }
    }

    /**
     * 静态调用方法
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        self::handle();
        return self::$hand_ob->$name(implode(",",$arguments));
    }

    /**
     * 调用方法
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        self::handle();
        return self::$hand_ob->$name(implode(",",$arguments));
    }
}