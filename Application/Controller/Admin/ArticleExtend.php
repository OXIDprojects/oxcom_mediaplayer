<?php
/**
 * Copyright © OXID Community. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxCom\MediaplayerModule\Application\Controller\Admin;

/**
 * Class ArticleExtend
 *
 * @package OxCom\MediaplayerModule\Application\Controller\Admin
 */
class ArticleExtend extends ArticleExtend_parent
{
    /**
     * Collects available article extended parameters, passes them to
     * Smarty engine and returns template file name "article_extend.tpl".
     *
     * @return string
     */
    public function render()
    {
        $return = parent::render();

        //load sorted media files
        $article = $this->_aViewData['edit'];
        if ($article) {
            $this->_aViewData['aMediaUrls'] = $article->getSortedMediaUrls();
        }
        return $return;
    }
}