<?php

declare(strict_types=1);

namespace RohaM\Rename\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use RohaM\Rename\form\RenameForm;
use RohaM\Rename\Loader;

final class RenameCommand extends Command {

    private Loader $plugin;

    public function __construct(Loader $plugin) {
        parent::__construct(
            "rename",
            "Rename the item in your hand",
            "/rename",
            ["rn"]
        );
        $this->plugin = $plugin;
        $this->setPermission("rename.command");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {
        if (!$sender instanceof Player) {
            $sender->sendMessage("This command can only be used in-game.");
            return true;
        }

        if (!$this->testPermission($sender)) {
            return true;
        }

        $item = $sender->getInventory()->getItemInHand();
        if ($item->isNull()) {
            $sender->sendMessage($this->plugin->getConfigManager()->getMessage("no-item"));
            return true;
        }

        RenameForm::send($sender, $this->plugin);
        return true;
    }
}