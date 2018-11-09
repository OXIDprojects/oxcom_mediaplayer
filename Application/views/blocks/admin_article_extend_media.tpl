
<tr>
    <td colspan="4">
        [{oxmultilang ident="OXCOM_MEDIAPLAYER_ENABLE"}]
        <input class="edittext" type="hidden" name="editval[oxarticles__enableoxcomplayer]" value='0'>
        <input class="edittext" type="checkbox" name="editval[oxarticles__enableoxcomplayer]" value='1' [{if $edit->getFieldData('enableoxcomplayer') == 1}]checked[{/if}] [{$readonly}]>
    </td>
</tr>
<tr>
    <td colspan="4">
        [{assign var=sortfieldName value="SHOP_MODULE_oxcomMediaplayerSortField_"|cat:$edit->getOxcomPlayerSortField()}]
        [{oxmultilang ident="OXCOM_MEDIAPLAYER_DATA_ORDERED_BY"}][{oxmultilang ident="$sortfieldName"}]
    </td>
</tr>

[{foreach from=$aMediaUrls item=oMediaUrl}]
    <tr>
        [{if $oddclass == 2}]
        [{assign var=oddclass value=""}]
        [{else}]
        [{assign var=oddclass value="2"}]
        [{/if}]
        <td class=listitem[{$oddclass}]>
            &nbsp;<a href="[{$oMediaUrl->getLink()}]" target="_blank">&raquo;&raquo;</a>&nbsp;
        </td>
        <td class=listitem[{$oddclass}]>
            &nbsp;<a href="[{$oViewConf->getSelfLink()}]&cl=article_extend&amp;mediaid=[{$oMediaUrl->oxmediaurls__oxid->value}]&amp;fnc=deletemedia&amp;oxid=[{$oxid}]&amp;editlanguage=[{$editlanguage}]" onClick='return confirm("[{oxmultilang ident="GENERAL_YOUWANTTODELETE"}]")'><img src="[{$oViewConf->getImageUrl()}]/delete_button.gif" border=0></a>&nbsp;
        </td>
        <td class="listitem[{$oddclass}]" width=250>
            <input style="width:100%" class="edittext" type="text" name="aMediaUrls[[{$oMediaUrl->oxmediaurls__oxid->value}]][oxmediaurls__oxdesc]" value="[{$oMediaUrl->oxmediaurls__oxdesc->value}]">
        </td>
        <td class=listitem[{$oddclass}]>
            <input class="edittext" size="10" type="text" name="aMediaUrls[[{$oMediaUrl->getFieldData('oxid')}]][oxmediaurls__oxcomplayersort]" value="[{$oMediaUrl->getFieldData('oxcomplayersort')}]">
        </td>
    </tr>
    [{/foreach}]

[{if $aMediaUrls->count()}]
    <tr>
        <td colspan="4" align="right">
            <input class="edittext" type="button" onclick="this.form.fnc.value='updateMedia';this.form.submit();" [{$readonly}] value="[{oxmultilang ident="ARTICLE_EXTEND_UPDATEMEDIA"}]">
            <br><br>
        </td>
    </tr>
    [{/if}]

<tr>
    <td colspan="4">
        [{oxmultilang ident="ARTICLE_EXTEND_DESCRIPTION"}]:<br>
        <input style="width:100%" type="text" name="mediaDesc" class="edittext" [{$readonly}]>
    </td>
</tr>

<tr>
    <td colspan="4">
        [{oxmultilang ident="ARTICLE_EXTEND_ENTERURL"}]:<br>
        <input style="width:100%" type="text" name="mediaUrl" class="edittext" [{$readonly}]>
    </td>
</tr>

<tr>
    <td colspan="4">
        [{oxmultilang ident="ARTICLE_EXTEND_UPLOADFILE"}]:<br>
        <input style="width:100%" type="file" name="mediaFile" class="edittext" [{$readonly}]>
    </td>
</tr>