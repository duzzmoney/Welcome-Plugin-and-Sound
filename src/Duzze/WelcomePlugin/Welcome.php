<?php

declare(strict_types=1);

namespace Duzze\WelcomePlugin;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\level\sound\GhastShootSound;
use pocketmine\utils\Config;

class WelcomePlugin extends PluginBase implements Listener {

    private Config $config;

    public function onEnable(): void {
        $this->getLogger()->info("WelcomePlugin ativado!");
        $this->saveDefaultConfig();
        $this->config = $this->getConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onPlayerJoin(PlayerJoinEvent $event): void {
        $player = $event->getPlayer();
        
        $welcomeMessage = $this->config->get("welcome_message", "Bem-vindo ao servidor!");
        
        $player->sendMessage(str_replace("\n", "\n", $welcomeMessage));

        $sound = new GhastShootSound ($player->getPosition());
        $player->getLevel()->addSound($sound);
    }
}
