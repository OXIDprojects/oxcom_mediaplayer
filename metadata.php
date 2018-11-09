<?php
/**
 * Copyright © OXID Community. All rights reserved.
 * See LICENSE file for license details.
 */

/**
 * Metadata version
 */
$sMetadataVersion = '2.1';

/**
 * Module information
 */
$aModule = array(
    'id'           => 'oxcom/mediaplayer',
    'title'        => 'OXID Hackathon 2018 MediaPlayer',
    'description'  => array(
        'de' => 'OXID Hackathon 2018 MediaPlayer',
        'en' => 'OXID Hackathon 2018 MediaPlayer',
    ),
    'thumbnail'    => 'logo.png',
    'version'      => '0.0.1',
    'author'       => 'OXID Hackathon 2018',
    'url'          => '',
    'email'        => 'info@oxid-esales.com',
    'extend'       => [
        \OxidEsales\Eshop\Application\Component\Widget\ArticleDetails::class  => \OxCom\MediaplayerModule\Application\Component\Widget\ArticleDetails::class,
        \OxidEsales\Eshop\Application\Model\Article::class => \OxCom\MediaplayerModule\Application\Model\Article ::class,
    ],
    'controllers' => [
    ],
    'events'       => [
        'onActivate'   => '\OxCom\MediaplayerModule\Core\Events::onActivate',
        'onDeactivate' => '\OxCom\MediaplayerModule\Core\Events::onDeactivate'
    ],
    'templates' => [],
    'blocks' => [
        [
            'template' => 'page/details/inc/tabs.tpl',
            'block' => 'details_tabs_longdescription',
            'file'=>  '/Application/views/blocks/details_tabs.tpl'
        ],
        [
            'template' => 'article_extend.tpl',
            'block' => 'admin_article_extend_media',
            'file'=>  '/Application/views/blocks/admin_article_extend_media.tpl'
        ],
    ],
    'settings' => [
        [
            'group' => 'oxcom_mediaplayer_settings',
            'name'  => 'oxcomMediaplayerShow',
            'type'  => 'bool',
            'value' => 'false'
        ],
    ]
);


