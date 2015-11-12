
Example (produces a JSON file with mapping from Zendesk languages/locales to Lingotek locales):

```
php ltk-map.php sample/zendesk.txt -json > sample/locale-map.zendesk.json
```

Example:
```
php ltk-map.php sample/zendesk.txt
```

```
Complete locale map:
{"ar":"ar","ar-eg":"ar-EG","ca":"ca-ES","cs":"cs-CZ","da":"da-DK","de":"de-DE","de-at":"de-AT","de-ch":"de-CH","el":"el-GR","en-au":"en-AU","en-ca":"en-CA","en-gb":"en-GB","en-ie":"en-IE","en-us":"en-US","es":"es-MX","es-419":"es-419","es-es":"es-ES","et":"et-EE","fi":"fi-FI","fil":"","fr":"fr-FR","fr-be":"fr-BE","fr-ca":"fr-CA","fr-ch":"fr-CH","fr-fr":"fr-FR","he":"he-IL","hi":"hi-IN","hr":"hr-HR","hu":"hu-HU","id":"id-ID","is":"is-IS","it":"it-IT","ja":"ja-JP","ko":"ko-KR","lt":"lt-LT","lv":"lv-LV","ms":"ms-MY","nl":"nl-NL","nl-be":"nl-BE","no":"no-NO","pl":"pl-PL","pt":"pt-BR","pt-br":"pt-BR","ro":"ro-RO","ru":"ru-RU","sk":"sk-SK","sl":"sl-SI","sr":"sr-CS","sr-me":"","sv":"sv-SE","th":"th-TH","tr":"tr-TR","uk":"uk-UA","vi":"vi-VN","zh-cn":"zh-CN","zh-tw":"zh-TW"}

Missing locales: ["fil","sr-me"]
Collisions: {"":2,"fr-FR":2,"pt-BR":2}

54/56 mapped (0.96%) -- 2 mapped to nothing (i.e., "")
```