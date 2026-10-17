<?php

declare(strict_types=1);

namespace RohaM\Rename;

use pocketmine\plugin\PluginBase;
use RohaM\Rename\command\RenameCommand;
use RohaM\Rename\manager\ConfigManager;

final class Loader extends PluginBase {

    private ConfigManager $configManager;

    protected function onEnable(): void {
        $this->saveDefaultConfig();

        $this->configManager = new ConfigManager($this);

        $this->getServer()->getCommandMap()->register(
            "rename",
            new RenameCommand($this)
        );

        $version = $this->getDescription()->getVersion();
        $this->getLogger()->info("§aRename §fv{$version} §aenabled.");
        $this->getLogger()->info("§7Author: §fRohaM §7| §7GitHub: §fhttps://github.com/JustRohams");
    }

    protected function onDisable(): void {
        $this->getLogger()->info("§cRename disabled.");
    }

    public function getConfigManager(): ConfigManager {
        return $this->configManager;
    }
}