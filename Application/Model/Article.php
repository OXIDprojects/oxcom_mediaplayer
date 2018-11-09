<?php
/**
 * Copyright © OXID Community. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxCom\MediaplayerModule\Application\Model;

/**
 * Class Article
 *
 * @package OxCom\MediaplayerModule\Application\Model
 */
class Article extends Article_parent
{

    /**
     * Show oxcom media player for this article yes/no
     */
    public function showOxcomMediaPlayer()
    {
        return $this->getFieldData('enableOxcomPlayer');
    }
}