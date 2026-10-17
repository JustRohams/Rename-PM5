<?php

declare(strict_types=1);

namespace RohaM\Rename\form;

use jojoe77777\FormAPI\SimpleForm;
use jojoe77777\FormAPI\CustomForm;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use RohaM\Rename\Loader;
use RohaM\Rename\manager\ConfigManager;

final class RenameForm {

    public static function send(Player $player, Loader $plugin): void {
        $config = $plugin->getConfigManager();

        $form = new CustomForm(static function (Player $player, ?array $data) use ($plugin): void {
            if ($data === null) {
                return; 
            }

            $config = $plugin->getConfigManager();

            $input = $data[0] ?? null;
            if (!is_string($input)) {
                $player->sendMessage($config->getMessage("invalid-name"));
                return;
            }

            $newName = trim($input);
            if ($newName === "") {
                $player->sendMessage($config->getMessage("invalid-name"));
                return;
            }

            $colorized = ConfigManager::translateColors($newName);
            $visible   = TextFormat::clean($colorized);
            $length    = mb_strlen($visible, "UTF-8");

            if ($length < $config->getMinLength()) {
                $player->sendMessage($config->getMessage("name-too-short", [
                    "min" => $config->getMinLength()
                ]));
                return;
            }

            if ($length > $config->getMaxLength()) {
                $player->sendMessage($config->getMessage("name-too-long", [
                    "max" => $config->getMaxLength()
                ]));
                return;
            }

            if (strlen($colorized) > 128) {
                $player->sendMessage($config->getMessage("name-too-long", [
                    "max" => $config->getMaxLength()
                ]));
                return;
            }

            $item = $player->getInventory()->getItemInHand();
            if ($item->isNull()) {
                $player->sendMessage($config->getMessage("no-item"));
                return;
            }

            $finalName = $config->isColorAllowed() ? $colorized : $visible;

            $item = clone $item;
            $item->setCustomName($finalName);
            $player->getInventory()->setItemInHand($item);

            $player->sendMessage($config->getMessage("success", ["name" => $finalName]));
        });

        $form->setTitle($config->getFormTitle());
        $form->addLabel($config->getFormContent());
        $form->addInput(
            $config->getInputLabel(),
            $config->getInputPlaceholder(),
            $config->getInputDefault()
        );

        $player->sendForm($form);
    }
}