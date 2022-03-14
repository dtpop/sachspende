# REDAXO-AddOn: Sachspende

## Was es macht

Mit dem AddOn kann man eine Spendenliste einrichten. Der Besucher der Website kann sich dann aus einem Formular die gewünschte Spende aussuchen, seinen Namen und seine E-Mail Adresse angeben und das Spendenversprechen abschicken.

Es können Teilspenden oder Komplettspenden angelegt werden.

Wenn eine Spende mit einer Anzahl größer als 1 angelegt wird, können Teilspenden geleistet werden. So können zum Beispiel 100 kg Nudeln ausgeschrieben werden. Der Besucher kann dann für 10 kg Nudeln ein Spendenversprechen abgeben. Diese 10 kg werden dann vom Spendenwunsch abgezogen und es können nur noch 90 kg Nudeln gespendet werden.

Es werden zwei E-Mails verschickt. Zum einen an den Spender, zum anderen an den Websitebetreiber. Der Spender bekommt zusätzlich einen Opt-In-Link, mit dem er seine Spende verifizieren kann.

## Installation

Zunächst das AddOn installieren, dabei werden die benötigten yform-Tabellen angelegt.

Dann das Modul über die Settings des AddOns anlegen und die E-Mail Templates installieren.

Dann in der Struktur einen Artikel anlegen für das Formular und dort das frisch installierte Formularmodul platzieren.

Dann einen Artikel für die Opt-In-Bestätigungsseite anlegen und mit Erfolgstext füllen.

Dann in den Settings des Addons die E-Mail Templates auswählen, die Betreiber-E-Mail-Adresse eintragen und den Opt-In-Erfolgsartikel zuordnen.

Das war's auch schon.

## Spendenwünsche erfassen

In der yform Tabelle können nun die Spendenwünsche erfasst werden. Der Erklärungstext hilft möglicherweise dem Besucher. Wenn beispielsweise 100 kg Nudeln gesucht werden, dann ist es wichtig, ob 500 g Päckchen Spaghetti oder Spiralnudeln, ob Vollkornnudeln auch ok sind und all sowas.

Die Anzahl sollte auf größer 1 eingestellt werden, sonst wird auf der Website nichts angezeigt.

Und schon kann es losgehen.

## Der Ablauf

Das Formular hat drei Schritte. Für jeden Schritt gibt es ein Fragment. Wenn das Fragment umgearbeitet werden soll, einfach in ein eigenes Verzeichnis kopieren und nach Wunsch umarbeiten.

Das Fragment sachspende_step_1.php macht die Spendenliste. sachspende_step_2.php macht die Adresseingabe und sachspende_step_3.php macht die Dankesseite.

Die Spendenversprechen landen in einer eigenen Datentabelle. Dabei wird das Spendenversprechen als Text gespeichert.

## Credits

Thomas Skerbis für die Idee und die Zusammenarbeit die Tests und den Einsatz.


## Lizenz

Das AddOn steht unter der MIT Lizenz und kann sowohl für private als auch für gewerbliche Zwecke frei verwendet werden.

(c) 2022 - Wolfgang Bund - wb@dtp-net.de - https://agile-websites.de