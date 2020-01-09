<?php
/**
 * @author denis909 <dev@denis909.spb.ru>
 * @license MIT
 * @link http://denis909.spb.ru
 */
namespace Denis909\ServiceLocator;

use Closure;

abstract class ServiceLocator
{

    protected static $_services = [];

    protected static function getService($name, $class, array $params = [])
    {
        if (array_key_exists($name, static::$_services))
        {
            return static::$_services[$name];
        }

        if ($class instanceof Closure)
        {
            static::$_services[$name] = $class();
        }
        elseif(is_object($class))
        {
            static::$_services[$name] = $class;
        }
        else
        {
            static::$_services[$name] = new $class(...$params);
        }
        
        return static::$_services[$name];
    }

}