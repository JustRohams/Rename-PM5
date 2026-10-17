# Rename

[![GitHub](https://img.shields.io/badge/GitHub-JustRohams%2FRename--PM5-blue?logo=github)](https://github.com/JustRohams/Rename-PM5)
[![API](https://img.shields.io/badge/PocketMine--MP-API%205-brightgreen)](https://github.com/pmmp/PocketMine-MP)
[![Version](https://img.shields.io/badge/Version-1.0.0-orange)](https://github.com/JustRohams/Rename-PM5/releases)
[![License](https://img.shields.io/badge/License-MIT-yellow)](LICENSE)
[![PHP](https://img.shields.io/badge/PHP-%3E%3D8.0-purple)](https://www.php.net/)

A clean, lightweight **PocketMine-MP 5** plugin that lets players rename the item in their hand via a beautiful UI form.

---

## ✨ Features

- ✅ Rename **any** item in your hand — blocks, tools, armor, anything!
- ✅ Clean **CustomForm** UI with a text input field
- ✅ Fully configurable messages and form texts (`config.yml`)
- ✅ Supports **`&` color codes** in item names and config
- ✅ Length validation (min / max characters)
- ✅ Multi-file, well-organized code structure
- ✅ Optimized, no lag, no bugs
- ✅ Uses the popular [FormAPI](https://github.com/jojoe77777/FormAPI) library

---

## 📋 Requirements

| Requirement | Version |
|-------------|---------|
| PocketMine-MP | **5.x** (API 5) |
| PHP | **8.0+** |
| [FormAPI](https://poggit.pmmp.io/p/FormAPI) | **2.x** by jojoe77777 (**required**) |

> ⚠️ The plugin will **not** load without `FormAPI` installed.

---

## 📦 Installation

1. Install **[FormAPI](https://poggit.pmmp.io/p/FormAPI)** on your server first.
2. Download the latest `Rename.phar` from [Releases](https://github.com/JustRohams/Rename-PM5/releases) — or clone this repo and build it yourself.
3. Drop `Rename.phar` into your server's `plugins/` folder.
4. Restart the server.
5. Edit `plugins/Rename/config.yml` if you want to customize messages.

---

## 🎮 Usage

1. Hold **any item** in your hand.
2. Run `/rename` (alias: `/rn`).
3. A form appears with a text field.
4. Type your new name (color codes like `&a`, `&l` are supported).
5. Press **Submit**.
6. Done! The item in your hand is renamed instantly. 🎉

If you're **not** holding anything, you'll see:

> `[Rename] You don't have anything in your hand.`

---

## 🔐 Permissions

| Permission | Default | Description |
|------------|---------|-------------|
| `rename.command` | `true` (everyone) | Allows the player to use `/rename` |

---

## ⚙️ Configuration

File: `plugins/Rename/config.yml`

```yaml
messages:
  prefix: "&8[&bRename&8] &r"
  no-item: "{prefix}&cYou don't have anything in your hand."
  invalid-name: "{prefix}&cInvalid name provided."
  name-too-short: "{prefix}&cName must be at least &e{min} &ccharacters long."
  name-too-long: "{prefix}&cName must be at most &e{max} &ccharacters long."
  success: "{prefix}&aItem renamed to &e{name}&a."

form:
  title: "&l&bRename Item"
  content: "&7Enter a new name for the item in your hand.\n&8Color codes are supported."
  input-label: "&eNew name"
  input-placeholder: "&7Type here..."
  input-default: ""
  min-length: 1
  max-length: 32
  allow-color-codes: true
```

### Placeholders

| Placeholder | Used in | Description |
|-------------|---------|-------------|
| `{prefix}` | all messages | Chat prefix |
| `{min}` | `name-too-short` | Minimum length |
| `{max}` | `name-too-long` | Maximum length |
| `{name}` | `success` | Final (colorized) item name |
| `\n` | any message / form | New line |

---

## 🗂️ Project Structure

```
Rename-PM5/
├── .gitignore
├── LICENSE
├── README.md
├── plugin.yml
├── resources/
│   └── config.yml
└── src/
    └── RohaM/
        └── Rename/
            ├── Loader.php
            ├── command/
            │   └── RenameCommand.php
            ├── form/
            │   └── RenameForm.php
            └── manager/
                └── ConfigManager.php
```

---

## 🤝 Contributing

Pull requests are welcome! For major changes, please open an issue first to discuss what you'd like to change.

---

## 🧑‍💻 Author

- **RohaM** — [@JustRohams](https://github.com/JustRohams)

---

## 📄 License

This project is licensed under the **MIT License** — see the [LICENSE](LICENSE) file for details.

---

## 🔗 Links

- 📦 Repository: <https://github.com/JustRohams/Rename-PM5>
- 🐛 Issues: <https://github.com/JustRohams/Rename-PM5/issues>
- 📚 FormAPI: <https://github.com/jojoe77777/FormAPI>