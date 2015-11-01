<?php namespace Phramework;

class InstallManager {
  var $composer;
  public static function postInstallCmd(Event $e){
    $this->composer = $e->getComposer();
    $vendordir = $this->composer->getConfig()->get('vendor-dir');
    $zip = new ZipArchive;
    
    if ($zip->open(realpath($vendordir.'/jimanx2/phramework/resources/phramework-skeleton.zip')) === TRUE) {
        $zip->extractTo(realpath($vendordir.'../'));
        $zip->close();
        echo 'App skeleton initialized!';
    } else {
        echo 'Failed to initialize App skeleton!';
    }
    
  }
}