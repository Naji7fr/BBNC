<div class="form-group">
    <label for="date">Datum *</label>
    <input type="date" id="date" name="date"
           value="{{ old('date', isset($lesson) ? $lesson->date->format('Y-m-d') : '') }}" required>
    @error('date')<div class="error">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="time">Tijd *</label>
    <input type="time" id="time" name="time"
           value="{{ old('time', isset($lesson) ? substr($lesson->time, 0, 5) : '') }}" required>
    @error('time')<div class="error">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="lesson_type_id">Les type *</label>
    <select id="lesson_type_id" name="lesson_type_id" required>
        <option value="">Selecteer les type</option>
        @foreach ($lessonTypes as $type)
            <option value="{{ $type->id }}"
                @selected(old('lesson_type_id', isset($lesson) ? $lesson->lesson_type_id : '') == $type->id)>
                {{ $type->name }}
            </option>
        @endforeach
    </select>
    @error('lesson_type_id')<div class="error">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="instructor_id">Instructeur *</label>
    <select id="instructor_id" name="instructor_id" required>
        <option value="">Selecteer instructeur</option>
        @foreach ($instructors as $instructor)
            <option value="{{ $instructor->id }}"
                @selected(old('instructor_id', isset($lesson) ? $lesson->instructor_id : '') == $instructor->id)>
                {{ $instructor->name }}
            </option>
        @endforeach
    </select>
    @error('instructor_id')<div class="error">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="location_id">Locatie *</label>
    <select id="location_id" name="location_id" required>
        <option value="">Selecteer locatie</option>
        @foreach ($locations as $location)
            <option value="{{ $location->id }}"
                @selected(old('location_id', isset($lesson) ? $lesson->location_id : '') == $location->id)>
                {{ $location->name }}
            </option>
        @endforeach
    </select>
    @error('location_id')<div class="error">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="max_participants">Max. deelnemers *</label>
    <input type="number" id="max_participants" name="max_participants" min="1"
           value="{{ old('max_participants', isset($lesson) ? $lesson->max_participants : '') }}" required>
    @error('max_participants')<div class="error">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="notes">Opmerkingen</label>
    <textarea id="notes" name="notes" rows="3">{{ old('notes', isset($lesson) ? $lesson->notes : '') }}</textarea>
    @error('notes')<div class="error">{{ $message }}</div>@enderror
</div>
