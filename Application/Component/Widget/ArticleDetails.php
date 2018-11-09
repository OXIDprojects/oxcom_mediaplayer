<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
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
    public function guidoAlpha()
    {
        $thingy = $this->getMediaFiles();
        $out = array();

        $thingy = is_null($thingy) ? [] : $thingy;

        foreach($thingy as $key => $object){
            $urlObj = $object->oxmediaurls__oxurl;
            $v = $urlObj->rawValue;
            if(in_array(strtolower(substr($v,-4)), array('.mp3', '.mp4'))){
                $out[$key] = $object;
            }

        }

        usort($out, array($this, "guidoBeta"));
        if(!$out) return false;
        return $out;
    }

    public function guidoBeta($a, $b)
    {
        return ($a->oxmediaurls__oxurl->rawValue > $b->oxmediaurls__oxurl->rawValue);
    }
}
