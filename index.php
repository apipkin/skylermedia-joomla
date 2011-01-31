<?php
    defined( '_JEXEC' ) or die ( 'Restricted access' );
    define( 'BASEPATH', dirname(__FILE__) );
    require_once(BASEPATH . DS . 'lib/utilities.php');

    $positionsAbove = array(
        array('name' => 'Drawer',        'multiple' => false),
        array('name' => 'Top',           'multiple' => true),
        array('name' => 'Header',        'multiple' => true),
        array('name' => 'Navigation',    'multiple' => false),
        array('name' => 'Gallery',       'multiple' => false),
        array('name' => 'Utility',       'multiple' => true),
        array('name' => 'Showcase',      'multiple' => true),
        array('name' => 'MainTop',       'multiple' => true),
        array('name' => 'Breadcrumbs',   'multiple' => false)
    );
    
    $positionsBelow = array(
        array('name' => 'MainBottom',    'multiple' => true),
        array('name' => 'Bottom',        'multiple' => true),
        array('name' => 'Footer',        'multiple' => true),
        array('name' => 'Copyright',     'multiple' => false)
    );

?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <jdoc:include type="head" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl; ?>/templates/skylermedia/css/base.css" />
</head>
<body>
    <div id="pageWrapper"><div id="page">
        <?php  
            foreach ( $positionsAbove as $p ) {
                echo $utils->buildModules($p['name'], $p['multiple']);
            }
        ?>
        <div class="c">
            <?php echo $utils->buildModules('ContentLeft'); ?>
            <div class="c-middle">
                <?php echo $utils->buildModules('ContentTop',true); ?>
                <jdoc:include type="component" />
                <?php echo $utils->buildModules('ContentBottom',true); ?>
            </div>
            <?php echo $utils->buildModules('ContentRight',true); ?>
        </div><!-- /content -->
        <?php  
            foreach ( $positionsBelow as $p ) {
                echo $utils->buildModules($p['name'], $p['multiple']);
            }
        ?>
    </div></div><!-- /page -->
    <jdoc:include type="modules" name="debug" />
</body>
</html>