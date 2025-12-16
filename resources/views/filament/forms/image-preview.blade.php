@if ($record?->image_background_url)
    <div class="col-span-2 mt-2">
        <label class="text-sm font-medium text-gray-700">
            Current Image
        </label>

        <div class="mt-2">
            <img
                src="{{ $record->image_background_url }}"
                style="max-height: 200px; border-radius: 8px"
            />
        </div>
    </div>
@endif
