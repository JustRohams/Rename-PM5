<?php

declare(strict_types=1);

namespace RohaM\Rename\manager;

use pocketmine\utils\Config;
use RohaM\Rename\Loader;

final class ConfigManager {

    private Config $config;

    public function __construct(Loader $plugin) {
        $this->config = $plugin->getConfig();
    }

    /**
     * @param string               $key
     * @param array<string, mixed> $replacements
     */
    public function getMessage(string $key, array $replacements = []): string {
        $raw = (string)$this->config->getNested("messages." . $key, "");
        $prefix = (string)$this->config->getNested("messages.prefix", "");

        $text = str_replace("{prefix}", $prefix, $raw);
        foreach ($replacements as $search => $replace) {
            $text = str_replace("{" . $search . "}", (string)$replace, $text);
        }

        return $this->colorize($text);
    }

    public function getFormTitle(): string {
        return $this->colorize((string)$this->config->getNested("form.title", "Rename"));
    }

    public function getFormContent(): string {
        return $this->colorize((string)$this->config->getNested("form.content", ""));
    }

    public function getInputLabel(): string {
        return $this->colorize((string)$this->config->getNested("form.input-label", "New name"));
    }

    public function getInputPlaceholder(): string {
        return $this->colorize((string)$this->config->getNested("form.input-placeholder", "Enter a name"));
    }

    public function getInputDefault(): string {
        return (string)$this->config->getNested("form.input-default", "");
    }

    public function getMinLength(): int {
        return max(1, (int)$this->config->getNested("form.min-length", 1));
    }

    public function getMaxLength(): int {
        return max($this->getMinLength(), (int)$this->config->getNested("form.max-length", 32));
    }

    public function isColorAllowed(): bool {
        return (bool)$this->config->getNested("form.allow-color-codes", true);
    }

    public function colorize(string $text): string {
        return str_replace("\\n", "\n", self::translateColors($text));
    }

    public static function translateColors(string $text): string {
        $codes = [
            '&0','&1','&2','&3','&4','&5','&6','&7','&8','&9',
            '&a','&b','&c','&d','&e','&f',
            '&k','&l','&m','&n','&o','&r',
            '&A','&B','&C','&D','&E','&F',
            '&K','&L','&M','&N','&O','&R',
        ];
        $replace = [
            '§0','§1','§2','§3','§4','§5','§6','§7','§8','§9',
            '§a','§b','§c','§d','§e','§f',
            '§k','§l','§m','§n','§o','§r',
            '§a','§b','§c','§d','§e','§f',
            '§k','§l','§m','§n','§o','§r',
        ];
        return str_replace($codes, $replace, $text);
    }
}