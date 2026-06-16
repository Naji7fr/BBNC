# BBNC — Lesbeheer

Laravel-applicatie voor het inplannen en bekijken van lessen (user story: Nieuwe les inplannen).

## Vereisten

- PHP 8.2+
- Composer

## Installatie

```bash
composer install
cp .env.example .env   # Windows: copy .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
```

## Starten

```bash
php artisan serve
```

Open [http://127.0.0.1:8000](http://127.0.0.1:8000)

## MVC-structuur

```
app/
├── Controllers/          ← Controller (C)
│   ├── Controller.php
│   ├── HomeController.php
│   └── LessonController.php
├── Models/               ← Model (M)
│   ├── Instructor.php
│   ├── Lesson.php
│   ├── LessonType.php
│   └── Location.php
├── Requests/
│   └── StoreLessonRequest.php
├── Services/
│   └── LessonService.php
└── Repositories/
    └── LessonRepository.php

resources/views/          ← View (V)
├── layout.blade.php      (basis layout)
├── home.blade.php        (home pagina)
├── lesoverzicht.blade.php (read — tabel)
└── les-create.blade.php  (create — formulier)
```

| MVC | Map | Bestanden |
|-----|-----|-----------|
| **Model** | `app/Models/` | Database-modellen |
| **View** | `resources/views/` | Blade-templates |
| **Controller** | `app/Controllers/` | Request afhandeling |

## Routes

| Route | Beschrijving |
|-------|--------------|
| `/` | Home pagina |
| `/lesoverzicht` | Overzicht van alle lessen (Read) |
| `/lessen/nieuw` | Formulier nieuwe les inplannen (Create) |

## Database (migrations)

| Tabel | Beschrijving |
|-------|--------------|
| `lesson_types` | Soorten lessen (Theorie, Praktijk) |
| `instructors` | Instructeurs |
| `locations` | Locaties |
| `lessons` | Ingeplande lessen (uniek op `date` + `time`) |

## Stored procedure

Lesson creation uses `sp_store_lesson` on **MySQL** (duplicate check + insert in one procedure).

Layer structure (PSR-12):

| Layer | Class | Responsibility |
|-------|-------|----------------|
| Controller | `LessonController` | HTTP, try/catch, redirects |
| Service | `LessonService` | Business logic, time normalization |
| Repository | `LessonRepository` | Calls `sp_store_lesson` (MySQL) |
| Contract | `LessonRepositoryInterface` | Repository abstraction |

SQLite (tests/local) falls back to the same rules in PHP when stored procedures are unavailable.

## User stories

Zie `docs/user-stories/` voor Gherkin-scenario's en acceptatiecriteria.
