<?php


namespace CoreWine\Http\Psr\Interfaces;
 
/**
 * Environment Interface
 *
 * @package CoreWine\Http
 */
interface EnvironmentInterface {
    public static function init(array $settings = []);
}
