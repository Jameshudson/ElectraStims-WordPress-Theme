<?php

require_once ("vendor/autoload.php");

if(class_exists("\modules\util\ClientScriptsStyles")){

  $styles = new \modules\util\ClientScriptsStyles();

    $styles->addStyles("custom-css", get_template_directory_uri() . "-child-updated/style.css", array('aurum-main'));

  $styles->addMobileStyle('custom-mobile-css',
                          get_template_directory_uri() . "-child-updated/assets/css/mobile.css",
                          array('custom-css'));

  $styles->addDesktopStyle('custom-desktop-css',
                           get_template_directory_uri() . "-child-updated/assets/css/desktop.css",
                           array('custom-css'));

    $styles->addDesktopStyle('custom-desktop-css',
        get_template_directory_uri() . "-child-updated/assets/css/home.css",
        array('custom-css'));
}

function lab_get_svg_child($svg_path, $id = null, $size = array(24, 24), $is_asset = true){

    if($is_asset)
      $svg_path = get_template_directory() . '-child-updated/assets/' .  $svg_path;

    if( ! $id)
      $id = sanitize_title(basename($svg_path));

    if(is_numeric($size))
      $size = array($size, $size);

    ob_start();

    echo file_get_contents($svg_path);

    $svg = ob_get_clean();

    $svg = preg_replace(
      array(
        '/^.*<svg/s',
        '/id=".*?"/i',
        '/width=".*?"/',
        '/height=".*?"/'
      ),
      array(
        '<svg', 'id="'.$id.'"',
        'width="'.$size[0].'px"',
        'height="'.$size[0].'px"'
      ),
      $svg
    );

    return $svg;
}
