<?php
/**
 * Configuration file for 'yii message/extract' command.
 *
 * This file is automatically generated by 'yii message/config' command.
 * It contains parameters for source code messages extraction.
 * You may modify this file to suit your needs.
 *
 * You can use 'yii message/config-template' command to create
 * template configuration file with detailed description for each parameter.
 */
return [
    'color' => null,
    'interactive' => true,
    'help' => null,
    #'sourcePath' => '@yii',
    'sourcePath' => dirname(dirname(__DIR__)),
    #'messagePath' => '@yii/messages',
    'messagePath' => __DIR__,
    'languages' => ['lt'],
    'translator' => 'Yii::t',
    'sort' => false,
    'overwrite' => true,
    'removeUnused' => true,
    #'markUnused' => true,
    'except' => [
        '.svn',
        '.git',
        '.gitignore',
        '.gitkeep',
        '.hgignore',
        '.hgkeep',
        '/common/messages',
        '/common/modules',
        '/migrations',
        '/BaseYii.php',
        '/vendor',
        '/runtime',
        '/tests',
        '/requirements.php'
    ],
    'only' => [
        '*.php'
    ],
    'format' => 'php',
    'db' => 'db',
    'sourceMessageTable' => '{{%source_message}}',
    'messageTable' => '{{%message}}',
    'catalog' => 'messages',
    'ignoreCategories' => [
        'promocode', 'user', 'order'
    ],
];
