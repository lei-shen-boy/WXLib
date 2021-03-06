<?php 
namespace WXLib\Tool;

class DecoratorCreater
{
    /**
     * 要对哪些类进行装饰
     * @var array
     */
    private $classes = array();
    
    public function addClass($class)
    {
        if (!in_array($class, $this->classes)) {
            array_push($this->classes, $class);
        }
    }
    
    public function addClasses($classes)
    {
        if (!is_array($this->classes)) {
            $this->classes = $classes;
        } else {
            $this->classes = array_merge($this->classes, $classes);
        }
    }
    
    /**
     * 
     * @param unknown $class
     * @return multitype: array maked up by \ReflectionMethod objects
     */
    public function getPublicMethods($class)
    {
        $methods = array();
        
        $reflection = new \ReflectionClass($class);
        $reflectionMethodObjects = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);
        foreach ($reflectionMethodObjects as $reflectionMethod) {
            $params = array();
            foreach ($reflectionMethod->getParameters() as $param) {
                array_push($params, $param->getName());
            }
            $methods[$reflectionMethod->getName()] = $params;
        }
        
        return $methods;
    }
    
    public function getAllMethods() {
        $methods = array();
        foreach ($this->classes as $class) {
            $myMethods = $this->getPublicMethods($class);
            $methods = array_merge($methods, $myMethods);
        }
        return $methods;
    }
    
    public function toMethodsString($methodsArray) {
        $string = '';
        foreach ($methodsArray as $methodName => $params) {
            $string .= $this->toMethodString($methodName, $params) . "\n";
        }
        
        return $string;
    }
    
    public function toMethodString($methodName, $params) {
        if (strpos($methodName, 'set') === 0) {
            $tpl = 
'
    public function %s(%s) 
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->%s(%s);
        } else {
            $this->setOption(\'\', %s);
        }
        
        return $this;
    }
';
            $params = implode(', ', $params) ? '$' . implode(', ', $params) : '';
            return sprintf(
                    $tpl,
                    $methodName,
                    $params,
                    $methodName,
                    $params,
                    $params
            );
        } else {
            $tpl = 
'
    public function %s() 
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->%s();
        } else {
            return $this->getOption(\'\');
        }
    }
';
            return sprintf(
                    $tpl,
                    $methodName,
                    $methodName
            );
        }
        
    }
    
    public function create()
    {
        return $this->toMethodsString($this->getAllMethods());
    }
}
?>