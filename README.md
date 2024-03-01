# Cubex Skeleton MVC

This is a skeleton project for Cubex MVC applications. With some basic integration/unit tests and some real basic
examples.

## Table of Contents

- [Cubex Skeleton MVC](#cubex-skeleton-mvc)
    * [Requirements](#requirements)
    * [Default Cubex Commands](#default-cubex-commands)
        + [Migrate](#migrate)
        + [Serve](#serve)
        + [Make Command](#make-command)
        + [FindTranslations](#findtranslations)
        + [Translate](#translate)
        + [PoToArr](#potoarr)

## Requirements

- Node ^20.2.0
- php ^8.2

## Default Cubex Commands

Below are all the default commands that either come with Cubex or are added by the skeleton.

### Migrate

```shell
cubex migrate 
```

Run all Migrations from the api dir. This command will search for all ```DalSchemaProvider``` classes and compare them
to the database. If the database is missing a table or column, it will be created.

This doesn't handle data migration, only the structure of the database. It will not remove tables that are
not in the schema.

---

### Serve

Creates a php-built-in server on the port and domain defied in the config file (defaults.ini).

```shell
cubex serve 
```

---

### Make Console Command

A command added by MrEssex/Cubex-CLI. This command will create a new command in the Src/Cli dir with some default
scaffolding making it easier to get started.

```shell
cubex make:console 
```

---

### FindTranslations

A command added by MrEssex/Cubex-Translate. This is a WIP command that will search the project for any strings and add
them to the _tpl.php file, if they are not already included. It searches for ```_(), _t(), _p()``` and```_sp()```
functions.

```shell
cubex findtranslations
```

### Translate

A command added by MrEssex/Cubex-Translate. This command will take the _tpl.php file and create a .po file for each
language defined as common. This command can also be run as ```cubex translate -l CODE``` to create a .po file for a
specific language.

```shell
cubex translate --common 
```

---

### PoToArr

A command added by MrEssex/Cubex-Translate. This command will take the .po files and create an array of translations for
each language. This command can also be run as ```cubex potoarr -l CODE``` to create an array of translations for a
specific language. This array will be used by the translation array catalog.

```shell
cubex potoarr --common 
```

---
