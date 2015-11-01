<?php namespace Phramework;

use Composer\Script\Event;

class InstallManager {

  private static function initSkel(Event $event){
    $zip = new \ZipArchive;
    $vendorPath = $event->getComposer()->getConfig()->get('vendor-dir');
    if ($zip->open(realpath($vendorPath.'/jimanx2/phramework/resources/phramework-skeleton.zip')) === TRUE) {
        $zip->extractTo(realpath($vendorPath.'/../'));
        $zip->close();
        echo 'ok';
    } else {
        echo 'failed';
    }
  }
  
  public static function runScript(Event $event){
    $args = $event->getArguments();
    switch($args[0]){
      case "init":
        return InstallManager::initSkel($event);
    }
  }
}