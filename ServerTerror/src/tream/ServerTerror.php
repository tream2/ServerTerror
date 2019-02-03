<?php

namespace tream;
//서버 기본 선언
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\block\Block;
// 이벤트 선언
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByBlockEvent;
// 연동소스 선언

class ServerTerror extends PluginBase implements Listener{
   public function onEnable(){
      $this->getServer()->getPluginManager()->registerEvents($this,$this);
   }
    public function onTouch(PlayerInteractEvent $event){
       $player = $event->getPlayer();
       $name = $player->getName();
       $block = $event->getBlock();
       $item = $player->getInventory()->getItemInHand();
       $pre = "§b[ §f알림 §b]§r§f ";
       if($block->getId () == Block::SIGN_POST or $block->getId () == Block::WALL_SIGN){
       	if($item->getId() == 325 && $item->getDamage() == 8){ 
       		$event->setCancelled();
       		$player->sendMessage($pre."표지판에 물설치는 태러위험때문에 금지되었어요!");
       		return true;
       	}
       }
       if($item->getId() == 325 && $item->getDamage() == 10){
       	$event->setCancelled();
       	$this->getServer()->broadcastMessage($pre."{$name}님이 용암태러를 시도하셨습니다");
       	$player->getInventory ()->removeItem($item);
       	return true;
       }
       if($item->getId() == 46){
       	$event->setCancelled();
       	$this->getServer()->broadcastMessage($pre."{$name}님이 TNT태러를 시도하셨습니다.");
       	$player->getInventory ()->removeItem($item);
       	return true;
       }
    }
}