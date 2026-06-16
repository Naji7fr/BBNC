<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Exceptions\DuplicateLessonException;
use App\Exceptions\LessonStoreException;
use App\Models\Lesson;
use App\Requests\StoreLessonRequest;
use App\Requests\UpdateLessonRequest;
use App\Services\LessonService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * CRUD controller for lesson scheduling (admin/medewerker only via staff middleware).
 */
class LessonController extends Controller
{
    public function __construct(
        private readonly LessonService $lessonService,
    ) {}

    /** Read: show all lessons in chronological order. */
    public function index(): View
    {
        try {
            $lessons = $this->lessonService->getAllLessons();

            return view('lesoverzicht', compact('lessons'));
        } catch (LessonStoreException) {
            abort(500, 'Lesoverzicht kon niet worden geladen.');
        }
    }

    /** Create: show form with dropdown options. */
    public function create(): View
    {
        return view('les-create', $this->lessonService->getFormData());
    }

    /** Create: persist new lesson via stored procedure. */
    public function store(StoreLessonRequest $request): RedirectResponse
    {
        try {
            $this->lessonService->storeLesson($request->validated());

            return redirect()
                ->route('lessons.index')
                ->with('success', 'Les succesvol ingepland.');
        } catch (DuplicateLessonException $exception) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['time' => $exception->getMessage()]);
        } catch (LessonStoreException) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Les kon niet worden opgeslagen. Probeer het opnieuw.');
        }
    }

    /** Update: show edit form pre-filled with lesson data. */
    public function edit(Lesson $lesson): View
    {
        return view('les-edit', array_merge(
            $this->lessonService->getFormData(),
            ['lesson' => $this->lessonService->getLesson($lesson->id)],
        ));
    }

    /** Update: save changes with duplicate time slot check. */
    public function update(UpdateLessonRequest $request, Lesson $lesson): RedirectResponse
    {
        try {
            $this->lessonService->updateLesson($lesson, $request->validated());

            return redirect()
                ->route('lessons.index')
                ->with('success', 'Les succesvol bijgewerkt.');
        } catch (DuplicateLessonException $exception) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['time' => $exception->getMessage()]);
        } catch (LessonStoreException) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Les kon niet worden bijgewerkt. Probeer het opnieuw.');
        }
    }

    /** Delete: remove lesson from database. */
    public function destroy(Lesson $lesson): RedirectResponse
    {
        try {
            $this->lessonService->deleteLesson($lesson);

            return redirect()
                ->route('lessons.index')
                ->with('success', 'Les succesvol verwijderd.');
        } catch (LessonStoreException) {
            return redirect()
                ->route('lessons.index')
                ->with('error', 'Les kon niet worden verwijderd. Probeer het opnieuw.');
        }
    }
}
