<div class="space-y-6">

    <div class="grid grid-cols-2 gap-4 text-sm">
        <div><strong>Action:</strong> {{ $activity->event }}</div>
        <div><strong>By:</strong> {{ optional($activity->causer)->email ?? 'System' }}</div>
        <div><strong>Model:</strong> {{ class_basename($activity->subject_type) }}</div>
        <div><strong>At:</strong> {{ $activity->created_at }}</div>
    </div>

    @php
        $old = $activity->properties['old'] ?? [];
        $new = $activity->properties['attributes'] ?? [];
    @endphp

    <div class="grid grid-cols-2 gap-6">
        <div>
            <h3 class="font-semibold text-red-600 mb-2">Old Values</h3>
            @forelse($old as $key => $value)
                <div class="text-sm">{{ $key }}: {{ is_array($value) ? json_encode($value) : $value }}</div>
            @empty
                <span class="text-gray-400 text-sm">No old values</span>
            @endforelse
        </div>

        <div>
            <h3 class="font-semibold text-green-600 mb-2">New Values</h3>
            @forelse($new as $key => $value)
                <div class="text-sm">{{ $key }}: {{ is_array($value) ? json_encode($value) : $value }}</div>
            @empty
                <span class="text-gray-400 text-sm">No new values</span>
            @endforelse
        </div>
    </div>

</div>
