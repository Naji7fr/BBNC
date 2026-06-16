# language: nl
@lesbeheer @read
Feature: Lesoverzicht bekijken

  Als instructeur
  Wil ik het lesoverzicht kunnen bekijken
  Zodat ik een overzicht heb van alle ingeplande lessen.

  Scenario: lesoverzicht wordt succesvol geladen
    Gegeven ik sta op de home pagina
    Wanneer ik navigeer naar de pagina "Lesoverzicht"
    Dan zie ik een tabel met alle ingeplande lessen
    En ik zie de knop "Nieuwe les inplannen"

  Scenario Outline: lesoverzicht toont lesgegevens per kolom
    Gegeven er is een les ingepland met de volgende gegevens:
      | datum           | <datum>           |
      | tijd            | <tijd>            |
      | les type        | <les_type>        |
      | instructeur     | <instructeur>     |
      | locatie         | <locatie>         |
      | max_deelnemers  | <max_deelnemers>  |
      | opmerkingen     | <opmerkingen>     |
    Wanneer ik navigeer naar de pagina "Lesoverzicht"
    Dan zie ik in de tabel een rij met:
      | datum           | <datum>           |
      | tijd            | <tijd>            |
      | les type        | <les_type>        |
      | instructeur     | <instructeur>     |
      | locatie         | <locatie>         |
      | max_deelnemers  | <max_deelnemers>  |
      | opmerkingen     | <opmerkingen>     |

    Voorbeelden:
      | datum      | tijd  | les_type | instructeur  | locatie  | max_deelnemers | opmerkingen     |
      | 11-06-2026 | 09:00 | Theorie  | Jan de Vries | Lokaal 1 | 20             |                 |
      | 11-06-2026 | 14:00 | Praktijk | Lisa Jansen  | Hal 2    | 12             | Beginners groep |
      | 12-06-2026 | 10:30 | Theorie  | Piet Bakker  | Lokaal 3 | 15             | Examen voorbereiding |
