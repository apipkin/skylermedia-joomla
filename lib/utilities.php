<?php

class SkylerMedia_Utilities {

    protected $_joomla;
    protected $_defaultPositions;
    protected $_lastCount = 0;
    
    public function __construct($joomla) {
        $this->_joomla = $joomla;
        $this->_defaultPositions = array('A','B','C','D','E','F');
    }
    
    public function getLastCount() {
        return $this->_lastCount;
    }
    
    public function countModule($name) {
        $count = $this->_joomla->countModules($name);
        $this->_lastCount = $count;
        return $count;
    }
    
    public function countModules($name, $options = null) {

        if ($options === null) {
            $options = $this->_defaultPositions;
        }

        $count = 0;
        $modules = array();
        

        if (count($options)) {
            foreach ($options as $o) {
                $count += ( $this->countModule( $name . '-' . $o ) > 0 );        
            }
        } else {
            $count = ( $this->countModules( $name ) > 0 );
        }
        
        $this->_lastCount = $count;
        return $count;
    }
    
    public function buildModules($name, $multiple = false, $options = null) {
        $modules = array();
        
        if ( $multiple ) {
            if ($options === null || !is_array($options)) {
                $options = $this->_defaultPositions;
            }
            foreach ($options as $o) {
                $module = $name . '-' . $o;
                if ($this->countModule($module)) {
                    $modules[] = $module;
                }
            }
        } else {
            if ( $this->countModule($name) ) {
                $modules[] = $name;
            }
        }
        
        $count = count($modules);
        
        if ($count < 1) {
            return '';
        }
        
        $output = '<div class="modules yui3-g g-' . strtolower($name) . '">';
        
        foreach ($modules as $m) {
            $grid = 'yui3-u-1';
            if ( $count > 1) {
                $grid .= '-' . $count;
            }
            $output .= '<div class="module m-' . strtolower($m) . ' ' . $grid . '"><div class="liner">'
                     . '<jdoc:include type="modules" name="' . $m . '" />'
                     . '</div></div>';
        }
        
        $output .= '</div>';
        
        return $output;
    }
}

$utils = new SkylerMedia_Utilities($this);