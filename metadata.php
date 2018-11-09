<?php
/**
 * This file is part of OXID eSales PayPal module.
 *
 * OXID eSales PayPal module is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OXID eSales PayPal module is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OXID eSales PayPal module.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      http://www.oxid-esales.com
 * @copyright (C) OXID eSales AG 2003-2018
 */

/**
 * Metadata version
 */
$sMetadataVersion = '2.0';

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
       // \OxidEsales\Eshop\Core\ViewConfig::class                              => \OxCom\MediaplayerModule\Core\ViewConfig::class,
        \OxidEsales\Eshop\Application\Component\Widget\ArticleDetails::class  => \OxCom\MediaplayerModule\Application\Component\Widget\ArticleDetails::class,
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
            'file'=>  '/views/blocks/details_tabs.tpl'
        ],
    ],
    'settings' => []
);


