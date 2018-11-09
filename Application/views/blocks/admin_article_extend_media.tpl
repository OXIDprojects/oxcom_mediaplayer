
<td class="edittext">
    [{oxmultilang ident="OXCOM_MEDIAPLAYER_ENABLE"}]
    <input class="edittext" type="hidden" name="editval[oxarticles__enableoxcomplayer]" value='0'>
    <input class="edittext" type="checkbox" name="editval[oxarticles__enableoxcomplayer]" value='1' [{if $edit->oxarticles__enableoxcomplayer->value == 1}]checked[{/if}] [{$readonly}]>
</td>

[{$smarty.block.parent}]