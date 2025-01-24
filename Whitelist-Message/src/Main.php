<?php

declare(strict_types=1);

namespace Sythv\Whitelist_Message;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\plugin\PluginBase;


class Main extends PluginBase implements Listener
{

    private static Main $instance;

    public function onLoad(): void
    {
        self::$instance = $this;
    }

    public static function getInstance(): self
    {
        return self::$instance;
    }

    protected function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("Enabled");
    }

    protected function onDisable(): void
    {
        $this->getLogger()->info("Disabled");
    }




    public function PreJoinMessage(PlayerPreLoginEvent $ev)
    {
        $player = $ev->getPlayerInfo();
        $whitelist = Main::getInstance()->getServer()->hasWhitelist();


        if ($whitelist && !Main::getInstance()->getServer()->isWhitelisted(strtolower($player->getUsername()))) {
            $ev->setKickFlag(PlayerPreLoginEvent::KICK_FLAG_SERVER_WHITELISTED,  "The server is currently under going maintenance");
        }
    }



}