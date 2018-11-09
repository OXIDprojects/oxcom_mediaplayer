<?php
/**
 * Copyright © OXID Community. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxCom\MediaplayerModule\Core;

/**
 * Class Events
 *
 * @package OxCom\MediaplayerModule\Core
 */
class Events
{
    /**
     * Module database fields
     *
     * @var array
     */
    protected static $moduleDatabaseFields = [
        'oxarticles' => [
            'field' => 'enableOxcomPlayer',
            'specification' => "tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Player is active'"
        ],
        'oxmediaurls' => [
            'field' => 'oxcomPlayerSort',
            'specification' => " int(11) NOT NULL DEFAULT '0' COMMENT 'Sorting'"
        ]
    ];

    /**
     * Module activation script.
     */
    public static function onActivate()
    {
        foreach (self::$moduleDatabaseFields as $table => $sub) {
            self::addDatabaseField($table, $sub['field'], $sub['specification']);
        }

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

    /**
     * Add module specific database field.
     *
     * @param string $table         Table name
     * @param string $field         Field name
     * @param string $specification Specification query part
     */
    protected static function addDatabaseField($table, $field, $specification)
    {
        $dbMetaDataHandler = oxNew(\OxidEsales\Eshop\Core\DbMetaDataHandler::class);

        if (!$dbMetaDataHandler->fieldExists($field, $table)) {
            $query = "ALTER TABLE `" . $table . "`" .
                     " ADD `" . strtoupper($field) . "` " . $specification;
            \OxidEsales\Eshop\Core\DatabaseProvider::getDb()->execute($query);
            $dbMetaDataHandler->updateViews([$table]);
        }
    }
}