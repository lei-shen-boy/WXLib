<?php
/**
 * 此类原作者是fabien@symfony.com(https://github.com/fabpot)
 * https://github.com/symfony/ClassLoader/blob/master/ClassLoader.php
 *
 */
class ClassLoader
{
    private $prefixes = array();
    private $useIncludePath = true;
    
    public function register($prepend = false)
    {
        spl_autoload_register(array($this, 'loadClass'), true, $prepend);
    }
    
    public function unregister()
    {
        spl_autoload_unregister(array($this, 'loadClass'));
    }
    
    public function add($prefix, $paths, $prepend = false)
    {
        $first = $prefix[0];
        if (!isset($this->prefixes[$first][$prefix])) {
            $this->prefixes[$first][$prefix] = (array) $paths;

            return;
        }
        if ($prepend) {
            $this->prefixes[$first][$prefix] = array_merge(
                (array) $paths,
                $this->prefixes[$first][$prefix]
            );
        } else {
            $this->prefixes[$first][$prefix] = array_merge(
                $this->prefixes[$first][$prefix],
                (array) $paths
            );
        }
    }
    
    public function loadClass($class)
    {
        if ($file = $this->findFile($class)) {
            include $file;
    
            return true;
        }
    }
    
    public function findFile($class)
    {
        if ('\\' == $class[0]) {
            $class = substr($class, 1);
        }
        
        if (false !== $pos = strrpos($class, '\\')) {
            // namespaced class name
            $classPath = strtr(substr($class, 0, $pos), '\\', DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
            $className = substr($class, $pos + 1);
        } else {
            // PEAR-like class name
            $classPath = null;
            $className = $class;
        }
        
        $classPath .= strtr($className, '_', DIRECTORY_SEPARATOR) . '.php';
        
        $first = $class[0];
        if (isset($this->prefixes[$first])) {
            foreach ($this->prefixes[$first] as $prefix => $dirs) {
                if (0 === strpos($class, $prefix)) {
                    foreach ($dirs as $dir) {
                        if (file_exists($dir . DIRECTORY_SEPARATOR . $classPath)) {
                            return $dir . DIRECTORY_SEPARATOR . $classPath;
                        }
                    }
                }
            }
        }
        
        if ($this->useIncludePath && $file = stream_resolve_include_path($classPath)) {
            return $file;
        }
    }
}
?>