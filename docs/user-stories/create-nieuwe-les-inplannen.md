# User Story: Nieuwe les inplannen (Create)

| Eigenschap   | Waarde                                      |
| ------------ | ------------------------------------------- |
| **ID**       | US-LES-001                                  |
| **Type**     | Create                                      |
| **Prioriteit** | Hoog                                      |
| **Epic**     | Lesbeheer                                   |

## User story

**Als** instructeur  
**Wil ik** een nieuwe les kunnen inplannen vanuit het lesoverzicht  
**Zodat** ik lessen kan registreren en beheren in het systeem.

## Acceptatiecriteria

### Scenario: nieuwe les wordt succesvol ingepland

```gherkin
Gegeven ik sta op de home pagina
En navigeer ik naar de pagina "Lesoverzicht"
En ik klik op de knop "Nieuwe les inplannen"
En ik krijg de pagina om een nieuwe les in te plannen
Wanneer ik alle verplichte velden invul
En ik klik op "Les opslaan"
Dan wordt de nieuwe les zichtbaar in het lesoverzicht
```

### Scenario: nieuwe les wordt niet ingepland

```gherkin
Gegeven ik sta op de home pagina
En navigeer ik naar de pagina "Lesoverzicht"
En ik klik op de knop "Nieuwe les inplannen"
En ik krijg de pagina om een nieuwe les in te plannen
Wanneer ik een datum en tijd selecteer waarop al een les is ingepland
En ik klik op "Les opslaan"
Dan krijg ik een foutmelding dat er al een les gepland staat op dit tijdstip
```

## Formuliervelden (Create)

| Veld            | Verplicht | Type        | Validatie                                      | Foutmelding                                      |
| --------------- | --------- | ----------- | ---------------------------------------------- | ------------------------------------------------ |
| Datum           | Ja        | Date picker | Mag niet leeg zijn                             | "Datum is verplicht"                             |
| Tijd            | Ja        | Time picker | Mag niet leeg zijn                             | "Tijd is verplicht"                              |
| Les type        | Ja        | Dropdown    | Moet een geldige optie zijn                    | "Les type is verplicht"                          |
| Instructeur     | Ja        | Dropdown    | Moet een geldige instructeur zijn              | "Instructeur is verplicht"                       |
| Locatie         | Ja        | Dropdown    | Moet een geldige locatie zijn                  | "Locatie is verplicht"                           |
| Max. deelnemers | Ja        | Number      | Moet groter zijn dan 0                         | "Max. deelnemers is verplicht"                   |
| Opmerkingen     | Nee       | Text area   | —                                              | —                                                |
| Datum + tijd    | Ja        | Combinatie  | Mag niet overlappen met bestaande les          | "Er staat al een les gepland op dit tijdstip"    |

## Business rules

| Regel | Beschrijving                                                                 |
| ----- | ---------------------------------------------------------------------------- |
| BR-01 | Een les kan alleen worden opgeslagen als alle verplichte velden zijn ingevuld. |
| BR-02 | Op hetzelfde tijdstip mag maximaal één les gepland staan.                    |
| BR-03 | Na succesvol opslaan wordt de gebruiker teruggeleid naar het lesoverzicht.   |
| BR-04 | De nieuwe les verschijnt direct in het lesoverzicht na opslaan.              |

## Navigatie

| Stap | Actie                          | Resultaat                              |
| ---- | ------------------------------ | -------------------------------------- |
| 1    | Home pagina                    | Startpunt                              |
| 2    | Navigeer naar "Lesoverzicht"   | Lesoverzicht pagina                    |
| 3    | Klik "Nieuwe les inplannen"    | Formulier nieuwe les inplannen         |
| 4    | Vul velden in + "Les opslaan"  | Les opgeslagen of validatiefout getoond |
