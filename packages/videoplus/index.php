<?php
/**
 * Videoplus template index file
 *
 * @category   Apptha
 * @package    videoplus
 * @version    2.1
 * @author     Apptha Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Apptha. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */

/** No direct access */
defined ( '_JEXEC' ) or die ( 'Restricted access' );

/** Import Joomla filesystem library */
jimport ( 'joomla.filesystem.folder' );
$positionLeft = $positionfooter = '';
$document = JFactory::getDocument ();
/** Define directory separator */
if (version_compare ( JVERSION, '3.0.0', 'ge' )) {
  if (! defined ( "DS" )) {
    define ( "DS", "/" );
  }
}

/** Check joomla version */
if (version_compare ( JVERSION, '1.7.0', 'ge' )) {
  $version = '1.7';
} elseif (version_compare ( JVERSION, '1.6.0', 'ge' )) {
  $version = '1.6';
} else {
  $version = '1.5';
}

/** Set videoplus theme positions */ 
if ($version != '1.5') {
  $positionRight = 'position-6';
  $positionMenu = 'position-1';
  $positionBread = 'position-2';
  $positioncopy = 'footerload';
  $positionLeft = 'footermenu';
  $positionfooter = 'user2';
} else {
  $positionRight = 'right';
  $positionMenu = 'user3';
  $positionBread = 'breadcrumb';
  $positionLeft = 'footermenu';
  $positionfooter = 'user2';
  $positioncopy = 'footer';
}

if (version_compare ( JVERSION, '3.0.0', 'ge' )) {
  /** Add JavaScript Frameworks */
  JHtml::_ ( 'bootstrap.framework' );
}

/** Include the file for load template modules. */
$strFbAppId   = $this->params->get ( 'Fb_app_id' );
$showIcons    = $this->params->get ( 'book_marking' );
$folderPath   = JPATH_SITE . DS . 'components' . DS . 'com_contushdvideoshare';
$hdvideoshare = JFolder::exists ( $folderPath );
$isEnable     = ($hdvideoshare) ? true : false;
$rightModule  = $this->countModules ( $positionRight );
$leftpositionContentWidth = ($this->countModules ( $positionRight ) > 0) ? "650" : "1000";
$leftContentWidth = ($rightModule != 0) ? "home" : $leftpositionContentWidth;

if (!version_compare(JVERSION, '3.0.0', 'ge')) {
  $document->addScript(JURI::base() . 'components/com_contushdvideoshare/js/jquery.js');
  $document->addScript(JURI::base() . 'components/com_contushdvideoshare/js/jquery-ui.js');
} else {
  JHtml::_('jquery.framework');
  JHtml::_('jquery.ui');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" 
lang="<?php echo $this->language; ?>" 
dir="<?php echo $this->direction; ?>">
<?php  
  /** Head section starts here
   * Include css for template
   */ ?>
  <head>
    <jdoc:include type="head" />
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />  
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.min.css" type="text/css" />  
    <?php if ($this->direction == 'rtl') { ?>
      <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template-rtl.min.css" type="text/css" />
    <?php } ?>
    <link href='http://fonts.googleapis.com/css?family=Francois+One&amp;v2' rel='stylesheet' type='text/css'></link>
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css' />
    <meta id="viewport" name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
  </head>
  <body>
    <div id="background">
      <div id="mainwrapper"> 
          
          <?php /** Header starts here */ ?>
          <div id="header" class="clearfix"> <jdoc:include type="modules" name="videoplus-header" /> </div>          
          <?php /** Header ends here */ ?>
          <div class="clear"></div>
          
          <?php /** Navigation menu starts here */ ?>
          <nav> <a href="javascript:void(0)" class="hidden-menu" onclick="toggle_Hide('menu');" id="hidden-menu">Menu 
              <span class="menu_grid">
                <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
              </span></a>
      
              <div class="nav" id="menu"> <jdoc:include type="modules" name="<?php echo $positionMenu;?>" /> </div> 
          </nav>
          <?php /** Navigation menu ends here */ ?> 
          <div class="clear"></div>
          
          <?php /** Breadcrumb starts here */ ?>
          <div id="breadcrumb">  <jdoc:include type="modules" name="<?php echo $positionBread; ?>" /> </div>
          <?php /** Breadcrumb ends here */ ?>
          
<?php /** Videoplus Banner section */
      $colorScheme  = '';
      $clscomponent = 'music_component';
      
      $videoID      = JRequest::getVar ( 'id' );
      $videoName    = JRequest::getVar ( 'video' );
      $view         = JRequest::getVar ( 'view' );
      
      if (($view == 'index' || $view == 'player') && empty ( $videoID ) && empty ( $videoName )) {
        $colorScheme      = '1';
        $clscomponent     = '';
        $leftContentWidth = 'home';
      }
      
      if ($isEnable && $colorScheme == '1') { ?>
          <jdoc:include type="modules" name="videoplus-banner" /> 
          
          <style type="text/css"> 
              #video-grid-container { background: white; padding: 15px 10px; margin-bottom: 15px; }
              #video-grid-container_pop { background: white; padding: 15px 10px; margin-bottom: 15px; }
              #video-grid-container_rec { background: white; padding: 15px 10px; margin-bottom: 15px; }
              .toprightmenu,#player_page,#rateid { display: none; }
          </style> 
<?php } ?>
        
          <div id="errormsg"> <jdoc:include type="message" /> </div> 
          
          <?php /** Main content starts here */ ?>
          <div id="leftmodule<?php echo $leftContentWidth; ?>"> 
            <div class="<?php echo $clscomponent; ?> clearfix"> <jdoc:include type="component" /> </div>
          </div>
          <?php /** Main content ends here */ ?>
          
          <?php /** Right module starts here */ ?>
          <div id="rightmodule"> <jdoc:include type="modules" name="<?php echo $positionRight; ?>" style="right" /> </div>
          <?php /** Right module ends here */ ?>
          <div class="clear"></div> 
          
<?php if ($isEnable) { ?> 
            <jdoc:include type="modules" name="videoplus-category" /> 
<?php } ?> 
            <jdoc:include type="modules" name="videoplus-bottom" /> 
      </div> <!--  Main wrapper section ends -->
    </div> <!-- Background section ends  -->
    
    <?php /** Footer section starts here */ ?>
    <div id="tech_footerbg" class="clearfix"> 
      <?php /** Footer module starts here */ ?>
      <div class="tech_footer"> 
        <div class="footermodule_left"> <jdoc:include type="modules" name="<?php echo $positionLeft; ?>" style="custom" /> </div> 
        
        <div class="footerrightcontent"> 
        <?php /** Facebook like button */ 
        if ($showIcons) { ?> 
          <div style="float: left; padding: 20px 0px 0px 0px; margin-bottom: 20px;"> 
              <div style="float: left;"> 
                <?php if ($strFbAppId) { 
                $fbURL = "//www.facebook.com/plugins/like.php?href=" . JURI::base () . "&amp;width=200&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=21&amp;appId=" . $strFbAppId ;
                ?> 
                <iframe src="<?php echo $fbURL; ?>" scrolling="no" frameborder="0" style="border: none; overflow: hidden; width: 95px; height: 21px;" allowTransparency="true"></iframe>
    <?php } ?> 
              </div>
          
              <?php /** Twitter share button */ ?> 
              <div style="float: left; width: 95px;"> 
                <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a> 
                <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script> 
              </div>
              
              <?php /** Google plus one */ ?> 
              <script type="text/javascript" src="http://apis.google.com/js/plusone.js"></script> 
              <div style="float: left; width: 73px;"> <g:plusone size="medium"></g:plusone> </div>
          </div>
    <?php } ?>
    
          <jdoc:include type="modules" name="<?php echo $positionfooter; ?>" /> 
        </div> 
        <div class="clear"></div> 
      </div> 
      <?php /** Footer module ends here */ ?>
    </div>
    
    <div class="sitedesign"> 
      <div class="copyright_wrapper"> <jdoc:include type="modules" name="<?php echo $positioncopy; ?>" /> </div>
    </div>
  
  <script type="text/javascript"> 
    function toggle_Hide(id){ 
       var e = document.getElementById(id); 
       if (e.style.display == 'block') {
          e.style.display = 'none';
          e.removeAttribute('style');
          document.getElementById('menu').style.display = 'none';
       } else if (e.style.display == '') {
          e.style.display = 'none';
          e.removeAttribute('style');
          document.getElementById('menu').style.display = 'none'
       } else {
          e.style.display = 'block';
       }
    }
  </script>
  </body>
</html>