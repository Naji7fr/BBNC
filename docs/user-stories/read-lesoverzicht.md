# User Story: Lesoverzicht bekijken (Read)

| Eigenschap   | Waarde                                      |
| ------------ | ------------------------------------------- |
| **ID**       | US-LES-002                                  |
| **Type**     | Read                                        |
| **Prioriteit** | Hoog                                      |
| **Epic**     | Lesbeheer                                   |

## User story

**Als** instructeur  
**Wil ik** het lesoverzicht kunnen bekijken  
**Zodat** ik een overzicht heb van alle ingeplande lessen en snel kan zien wanneer en waar lessen plaatsvinden.

## Acceptatiecriteria

### Scenario: lesoverzicht wordt succesvol geladen

```gherkin
Gegeven ik sta op de home pagina
Wanneer ik navigeer naar de pagina "Lesoverzicht"
Dan zie ik een tabel met alle ingeplande lessen
En elke rij toont de kolommen uit het lesoverzicht
En ik zie de knop "Nieuwe les inplannen"
```

### Scenario: lesoverzicht toont nieuw ingeplande les

```gherkin
Gegeven er is een les succesvol ingepland
Wanneer ik navigeer naar de pagina "Lesoverzicht"
Dan zie ik de nieuwe les in de tabel staan
En de gegevens komen overeen met wat ik heb ingevuld bij het inplannen
```

### Scenario: lesoverzicht is leeg

```gherkin
Gegeven er zijn geen lessen ingepland
Wanneer ik navigeer naar de pagina "Lesoverzicht"
Dan zie ik een lege tabel of een melding dat er geen lessen zijn
En ik zie de knop "Nieuwe les inplannen"
```

## Read table — lesoverzicht kolommen

| Kolom           | Type     | Zichtbaar | Sorteerbaar | Filterbaar | Beschrijving                                      | Voorbeeld              |
| --------------- | -------- | --------- | ----------- | ---------- | ------------------------------------------------- | ---------------------- |
| Datum           | Date     | Ja        | Ja          | Ja         | Datum waarop de les plaatsvindt                   | 11-06-2026             |
| Tijd            | Time     | Ja        | Ja          | Nee        | Starttijd van de les                              | 14:00                  |
| Les type        | Text     | Ja        | Ja          | Ja         | Soort les (bijv. theorie, praktijk)               | Praktijk               |
| Instructeur     | Text     | Ja        | Ja          | Ja         | Naam van de instructeur                           | Jan de Vries           |
| Locatie         | Text     | Ja        | Ja          | Ja         | Locatie waar de les plaatsvindt                   | Hal 2                  |
| Max. deelnemers | Number   | Ja        | Ja          | Nee        | Maximum aantal deelnemers voor de les             | 12                     |
| Opmerkingen     | Text     | Ja        | Nee         | Nee        | Optionele extra informatie over de les            | Beginners groep        |
| Acties          | Buttons  | Ja        | Nee         | Nee        | Acties per les (bijv. bekijken, bewerken, verwijderen) | —                  |

## Read table — voorbeelddata

| Datum      | Tijd  | Les type | Instructeur   | Locatie | Max. deelnemers | Opmerkingen       |
| ---------- | ----- | -------- | ------------- | ------- | --------------- | ----------------- |
| 11-06-2026 | 09:00 | Theorie  | Jan de Vries  | Lokaal 1| 20              | —                 |
| 11-06-2026 | 14:00 | Praktijk | Lisa Jansen   | Hal 2   | 12              | Beginners groep   |
| 12-06-2026 | 10:30 | Theorie  | Piet Bakker   | Lokaal 3| 15              | Examen voorbereiding |

## Business rules

| Regel | Beschrijving                                                              |
| ----- | ------------------------------------------------------------------------- |
| BR-05 | Het lesoverzicht toont alle ingeplande lessen in chronologische volgorde. |
| BR-06 | Standaard wordt gesorteerd op datum en tijd (oplopend).                   |
| BR-07 | Alleen ingelogde instructeurs mogen het lesoverzicht bekijken.            |
| BR-08 | Een nieuw opgeslagen les verschijnt direct in het lesoverzicht (Read).    |

## Relatie met Create user story

| Create actie                         | Read resultaat                                      |
| ------------------------------------ | --------------------------------------------------- |
| Les opslaan met geldige gegevens     | Nieuwe rij zichtbaar in lesoverzicht tabel          |
| Les opslaan met dubbel tijdstip      | Geen nieuwe rij; foutmelding op create-formulier    |
| Les opslaan met ontbrekende velden   | Geen nieuwe rij; validatiefout op create-formulier  |
