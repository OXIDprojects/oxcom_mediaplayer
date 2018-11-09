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
    protected $sortedMediaUrls = null;

    /**
     * Show oxcom media player for this article yes/no
     */
    public function showOxcomMediaPlayer()
    {
        return $this->getFieldData('enableOxcomPlayer');
    }

    /**
     * Return sorted article media URL.
     */
    public function getSortedMediaUrls()
    {
        if ($this->sortedMediaUrls === null) {
            $this->sortedMediaUrls = oxNew(\OxidEsales\Eshop\Core\Model\ListModel::class);
            $this->sortedMediaUrls->init('oxmediaurl');
            $this->sortedMediaUrls->getBaseObject()->setLanguage($this->getLanguage());

            $viewNameGenerator = \OxidEsales\Eshop\Core\Registry::get(\OxidEsales\Eshop\Core\TableViewNameGenerator::class);
            $viewName = $viewNameGenerator->getViewName('oxmediaurls', $this->getLanguage());
            $query = "SELECT * FROM {$viewName} WHERE oxobjectid = '" . $this->getId() . "'" .
                     " ORDER BY " . $this->getOxcomPlayerSortField();
            $this->sortedMediaUrls->selectString($query);
        }

        return $this->sortedMediaUrls;
    }

    /**
     * Sortfield getter
     *
     * @return string
     */
    public function getOxcomPlayerSortField()
    {
        $sortfield = \OxidEsales\Eshop\Core\Registry::getConfig()->getConfigParam('oxcomMediaplayerSortField');
        $sortfield = empty($sortfield) ? 'oxcomplayersort' : $sortfield;
        return $sortfield;
    }
}