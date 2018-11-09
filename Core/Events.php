<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxCom\MediaplayerModule\Core;

/**
 * Class Events
 */
class Events
{
    /**
     * Module activation script.
     */
    public static function onActivate()
    {
        self::clearTmp();
    }
    /**
     * Module deactivation script.
     */
    public static function onDeactivate()
    {
        self::clearTmp();
    }
    /**
     * Clean temp folder content.
     *
     * @param string $clearFolderPath Sub-folder path to delete from. Should be a full, valid path inside temp folder.
     *
     * @return boolean
     */
    public static function clearTmp($clearFolderPath = '')
    {
        $folderPath = self::_getFolderToClear($clearFolderPath);
        $directoryHandler = opendir($folderPath);
        if (!empty($directoryHandler)) {
            while (false !== ($fileName = readdir($directoryHandler))) {
                $filePath = $folderPath . DIRECTORY_SEPARATOR . $fileName;
                self::_clear($fileName, $filePath);
            }
            closedir($directoryHandler);
        }
        return true;
    }

    /**
     * Check if provided path is inside eShop `tpm/` folder or use the `tmp/` folder path.
     *
     * @param string $clearFolderPath
     *
     * @return string
     */
    protected static function _getFolderToClear($clearFolderPath = '')
    {
        $templateFolderPath = (string) \OxidEsales\Eshop\Core\Registry::getConfig()->getConfigParam('sCompileDir');
        if (!empty($clearFolderPath) and (strpos($clearFolderPath, $templateFolderPath) !== false)) {
            $folderPath = $clearFolderPath;
        } else {
            $folderPath = $templateFolderPath;
        }
        return $folderPath;
    }
    /**
     * Check if resource could be deleted, then delete it's a file or
     * call recursive folder deletion if it's a directory.
     *
     * @param string $fileName
     * @param string $filePath
     */
    protected static function _clear($fileName, $filePath)
    {
        if (!in_array($fileName, ['.', '..', '.gitkeep', '.htaccess'])) {
            if (is_file($filePath)) {
                @unlink($filePath);
            } else {
                self::clearTmp($filePath);
            }
        }
    }
}