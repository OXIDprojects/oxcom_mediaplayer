[{* $smarty.block.parent *}]
[{oxhasrights ident="SHOWLONGDESCRIPTION"}]
    [{assign var="oLongdesc" value=$oDetailsProduct->getLongDescription()}]
    [{if $oLongdesc->value}]
    [{capture append="tabs"}]<a href="#description" data-toggle="tab">[{oxmultilang ident="DESCRIPTION"}]</a>[{/capture}]
    [{capture append="tabsContent"}]
    <div id="description" class="tab-pane[{if $blFirstTab}] active[{/if}]" itemprop="description">
        [{oxeval var=$oLongdesc}]
        [{if $oDetailsProduct->oxarticles__oxexturl->value}]
        <a id="productExturl" class="js-external" href="http://[{$oDetailsProduct->oxarticles__oxexturl->value}]">
            [{if $oDetailsProduct->oxarticles__oxurldesc->value}]
            [{$oDetailsProduct->oxarticles__oxurldesc->value}]
            [{else}]
            [{$oDetailsProduct->oxarticles__oxexturl->value}]
            [{/if}]
        </a>
        [{/if}]
        [{if $oView->guidoAlpha() || $oDetailsProduct->oxarticles__oxfile->value}]

        [{oxstyle include=$oViewConf->getModuleUrl('oxcom/mediaplayer','out/css/jplayer/jplayer.blue.monday.min.css' priority=1}]
        [{oxscript include=$oViewConf->getModuleUrl('oxcom/mediaplayer','out/js/jplayer/jquery.min.js' priority=1}]
        [{oxscript include=$oViewConf->getModuleUrl('oxcom/mediaplayer','out/js/jplayer/jquery.jplayer.min.js' priority=1}]
        [{oxscript include=$oViewConf->getModuleUrl('oxcom/mediaplayer','out/js/jplayer/jplayer.playlist.min.js' priority=1}]

[{capture name="jplayerdata"}]
        //<![CDATA[
        $(document).ready(function(){

                new jPlayerPlaylist({
                        jPlayer: "#jquery_jplayer_1",
                        cssSelectorAncestor: "#jp_container_1"
                }, [
        [{foreach from=$oView->guidoAlpha() item=oMediaUrl}]
                        {
                                title:"[{$oMediaUrl->oxmediaurls__oxdesc->value}]",
                                free:true,
                                mp3:"[{$oViewConf->getHomeLink()}]out/media/[{$oMediaUrl->oxmediaurls__oxurl->value}]"
                        },
        [{/foreach}]
                ], {
                        swfPath: "./js",
                        supplied: "oga, mp3",
                        useStateClassSkin: true,
                        autoBlur: true,
                        smoothPlayBar: true,
                        keyEnabled: true,
                        audioFullScreen: false
                });
        });
        //]]>
[{/capture}]

[{oxscript add=$smarty.capture.jplayerdata}]

<div id="jquery_jplayer_1" class="jp-jplayer"></div>
<div id="jp_container_1" class="jp-audio" role="application" aria-label="media player">
        <div class="jp-type-playlist">
                <div class="jp-gui jp-interface">
                        <div class="jp-controls">
                                <button class="jp-previous" role="button" tabindex="0">previous</button>
                                <button class="jp-play" role="button" tabindex="0">play</button>
                                <button class="jp-next" role="button" tabindex="0">next</button>
                                <button class="jp-stop" role="button" tabindex="0">stop</button>
                        </div>
                        <div class="jp-progress">
                                <div class="jp-seek-bar">
                                        <div class="jp-play-bar"></div>
                                </div>
                        </div>
                        <div class="jp-volume-controls">
                               <button class="jp-mute" role="button" tabindex="0">mute</button>
                                <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                                <div class="jp-volume-bar">
                                        <div class="jp-volume-bar-value"></div>
                                </div>
                        </div>
                        <div class="jp-time-holder">
                                <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
                                <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
                        </div>
                        <div class="jp-toggles">
                                <button class="jp-repeat" role="button" tabindex="0">repeat</button>
                                <button class="jp-shuffle" role="button" tabindex="0">shuffle</button>
                        </div>
                </div>
                <div class="jp-playlist">
                        <ul>
                                <li>&nbsp;</li>
                        </ul>
                </div>
                <div class="jp-no-solution">
                        <span>Update erforderlich</span>
                        Um die Musikst&uuml;cke abspielen zu k&ouml;nnen ist ein neuerer Browser oder das <a href="http://get.adobe.com/flashplayer/" target="_blank">Flashplugin</a> erforderlich.
                </div>
        </div>
</div>

        [{/if}]
    </div>
    [{/capture}]
    [{assign var="blFirstTab" value=false}]
    [{/if}]
[{/oxhasrights}]
