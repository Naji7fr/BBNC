# language: nl
@lesbeheer @create
Feature: Nieuwe les inplannen

  Als instructeur
  Wil ik een nieuwe les kunnen inplannen vanuit het lesoverzicht
  Zodat ik lessen kan registreren en beheren in het systeem.

  Scenario: nieuwe les wordt succesvol ingepland
    Gegeven ik sta op de home pagina
    En navigeer ik naar de pagina "Lesoverzicht"
    En ik klik op de knop "Nieuwe les inplannen"
    En ik krijg de pagina om een nieuwe les in te plannen
    Wanneer ik alle verplichte velden invul
    En ik klik op "Les opslaan"
    Dan wordt de nieuwe les zichtbaar in het lesoverzicht

  Scenario: nieuwe les wordt niet ingepland
    Gegeven ik sta op de home pagina
    En navigeer ik naar de pagina "Lesoverzicht"
    En ik klik op de knop "Nieuwe les inplannen"
    En ik krijg de pagina om een nieuwe les in te plannen
    Wanneer ik een datum en tijd selecteer waarop al een les is ingepland
    En ik klik op "Les opslaan"
    Dan krijg ik een foutmelding dat er al een les gepland staat op dit tijdstip
