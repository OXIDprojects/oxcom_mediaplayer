# oxcom_mediaplayer

JPlayer Mediaplayer integration

Features:
* JPlayer integrated into article details description tab.
* Show playable media files (m4v, mp3, wav, ogg) in article details description tab if any exist.
* Mediafiles in article description are grouped by type (group order is hardcoded atm) and 
  sorted depending on module settings (see below).

Settings:
* Enable/disable JPlayer display in article details description tab.
* JPlayer display is enabled by default for each article but can
  be disabled per article in shop admin product section extended MediaUrls.
* Media data can be ordered by 
  - numeric module sortfield   
  - description (multilanguage)
  - url
  - oxtimestamp

Install:

```bash
composer require oxid-projects/oxcom-mediaplayer
```
