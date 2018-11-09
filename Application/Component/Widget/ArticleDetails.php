<?php
/**
 * Copyright © OXID Community. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxCom\MediaplayerModule\Application\Component\Widget;

/**
 * Class ArticleDetails
 *
 * @package OxCom\MediaplayerModule\Core
 */
class ArticleDetails extends ArticleDetails_parent
{
    /**
     * List of supported file extensions.
     *
     * @var array
     */
    protected $supportedFileExtensions = ['mp3', 'm4v', 'ogg', 'webm', 'wav'];

    /**
     *
     *
     * @return string
     */
    public function getSupportedFileExtensions()
    {
        return implode(', ', $this->supportedFileExtensions);
    }

    /**
     * @return array|bool
     */
    public function fetchSortedMediaData()
    {
        $allFiles = $this->getMediaFiles();
        $allFiles = is_null($allFiles) ? [] : $allFiles;
        $return = [];

        foreach($allFiles as $key => $mediaUrl){
            $urlValue = $mediaUrl->getFieldData('oxurl');
            $tmp = explode('.', $urlValue);
            $extension = strtolower(array_pop($tmp));

            if (in_array($extension, $this->supportedFileExtensions)) {
                $return[$extension][$key] = $mediaUrl;
            }
        }

        foreach (array_keys($return) as $type) {
            usort($return[$type], array($this, 'sortMediaFiles'));
        }

        return $return;
    }

    /**
     * @param \OxidEsales\Eshop\Application\Model\MediaUrl $first
     * @param \OxidEsales\Eshop\Application\Model\MediaUrl $second
     *
     * @return bool
     */
    protected function sortMediaFiles($first, $second)
    {
        return ($first->getFieldData('oxurl') > $second->getFieldData('oxurl'));
    }
}
