<?php
/**
 * Created by PhpStorm.
 * User: romix
 * Date: 8/1/2017
 * Time: 01:28 AM
 */

namespace Core\Model;

/**
 * Class Repository
 * @package Core\Model
 */
class Repository
{
    const MODEL_PATH = 'model';

    /**
     * @var array
     */
    protected static $classes = [];

    /**
     * @var array
     */
    protected static $underscore = [];

    /**
     * @param string $name
     * @return mixed
     */
    public static function getModel($name)
    {
        if (isset(self::$underscore[$name]) && isset(self::$classes[self::$underscore[$name]]) ) {
            return self::$classes[self::$underscore[$name]];
        } else {
            return self::get($name);
        }
    }

    /**
     * @param string $path
     * @return mixed
     */
    public static function get($path)
    {
        $classPath = self::underscore($path);

        if (!isset(self::$classes[$classPath])
            || !is_subclass_of(self::$classes[$classPath], AbstractModel::class, false)
        ) {
            self::$classes[$classPath] = self::create($classPath);
        }

        return self::$classes[$classPath];
    }

    /**
     * @param string $name
     * @return string
     */
    public static function getClassPath($name)
    {
        return trim(strtolower(str_replace(CD, FD, $name)));
    }

    /**
     * @param $path
     * @return null | AbstractModel
     */
    public static function create($path)
    {
        $path = ucwords(str_replace('_', ' ', $path));
        $path = ucwords(str_replace(FD, ' ', str_replace(' ', '', $path)));
        $filePath = str_replace(' ', FD, $path) . '.php';
        $class = str_replace(' ', CD, $path);

        if (file_exists(BASEDIR. FD . $filePath)) {
            $object = null;
            try {
                $object = new $class();
            } catch (\Error $e) {
                echo $e->getMessage();
                echo $e->getTrace();
            }
            return $object;
        } else {
            echo 'File ' . $filePath . ' | ' . $class . ' not exist. In ' . __FILE__ . ': ' . __LINE__;
        }
        return null;
    }

    /**
     * @param $name
     * @return string
     */
    protected static function underscore($name)
    {
        if (isset(self::$underscore[$name])) {
            return self::$underscore[$name];
        }
        $result = strtolower(trim(preg_replace('/([A-Z]+)/', "_$1", $name), '_'));
        $result = str_replace(CD . '_', FD, $result);
        self::$underscore[$name] = $result;
        return $result;
    }
}
