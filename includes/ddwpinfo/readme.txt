(English description below the German description.)

## DE:
Diese Info-Bibliothek (Library) ist kein eigenständiges Plugin, sondern fungiert als Zusatzpaket in den Sprach-Plugins von DECKERWEB. Die Daten werden nur einmal geladen, je nachdem, welches Sprach-Plugin zuerst aktiv ist bzw. von WordPress geladen wird, lädt dann auch die Info-Seiten mit. Alle Zusatz-Plugins, welche die Bibliothek verwenden, hängen sich dann via Einhängepunkt (Action Hook) bzw. Filter ein.

Diese Bibliothek ist nicht übersetzbar wie meine sonstigen WordPress Plugins, da sie nur für den Einsatz im deutschsprachigen Umfeld vorgesehen ist. Außerdem wird so eine Vermischung mit Strings der unterstützten Plugins vermieden.


## EN:
This info library is not a plugin on itself but works as an additional package in the Sprach-Plugins (language pack plugins) of DECKERWEB by David Decker. All data is only loaded once; the first loaded/ active plugin from WordPress will load it. All additional plugins using the library only use it via action hooks or filters.

This library is not translateable like my other WordPress plugins. This is by intention as the library is only for usage in German-based environment. Also, mixing up with strings from the supported plugins is easily avoided this way.


## Changelog:

= 1.0.2 (2014-09-12) =
* UPDATE: Maintenance update; only cosmetic internal updates.

= 1.0.1 (2014-03-03) =
* UPDATE: Changed all user relevant admin URLs from 'network_admin_url()' to 'admin_url()' to improve compatibility for non-Network activated plugins.

= 1.0.0 (2014-02-09) =
* Initial release.