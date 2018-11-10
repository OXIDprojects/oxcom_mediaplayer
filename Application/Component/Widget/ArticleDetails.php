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
    protected $groupedFiles = [
        'm4v'  => [],
        'mp3'  => [],
        'wav'  => [],
        'ogg'  => []
    ];

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
     * Get supported file extensions for template
     *
     * @return string
     */
    public function getSupportedFileExtensionsForDisplay()
    {
        return implode(', ', $this->getSupportedFileExtensions());
    }
    /**
     * Get supported file extensions for template
     *
     * @return string
     */
    public function getSupportedFileExtensions()
    {
        return array_keys($this->groupedFiles);
    }

    /**
     * @return array|bool
     */
    public function fetchSortedMediaData()
    {
        $allFiles = $this->getSortedMediaFiles();
        $allFiles = is_null($allFiles) ? [] : $allFiles;
        $return = $this->groupedFiles;

        foreach($allFiles as $key => $mediaUrl){
            $urlValue = $mediaUrl->getFieldData('oxurl');
            $tmp = explode('.', $urlValue);
            $extension = strtolower(array_pop($tmp));

            if (in_array($extension, $this->getSupportedFileExtensions())) {
                $return[$extension][$key] = $mediaUrl;
            }
        }

        return $return;
    }
}
