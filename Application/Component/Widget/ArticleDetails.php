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
     * Sorted media urls.
     *
     * @var array
     */
    protected $sortedMediaFiles = null;

    /**
     * Template variable getter. Returns media files of current product.
     *
     * @return array
     */
    public function getSortedMediaFiles()
    {
        if ($this->sortedMediaFiles === null) {
            $sortedMediaFiles = $this->getProduct()->getSortedMediaUrls();
            $this->sortedMediaFiles = count($sortedMediaFiles) ? $sortedMediaFiles : false;
        }

        return $this->sortedMediaFiles;
    }

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
        $allFiles = $this->getSortedMediaFiles();
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

        return $return;
    }
}
