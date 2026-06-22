<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Booking Sheet - FURCARE</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f8fafc; min-height: 100vh; }

        /* ── Main ── */
        .main { padding: 28px 32px; padding-top: 100px; }

        /* ── Header bar ── */
        .sheet-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 20px; flex-wrap: wrap; gap: 12px;
        }
        .sheet-title { font-size: 26px; font-weight: 800; color: #0f172a; }
        .sheet-date-label { font-size: 14px; color: #64748b; margin-top: 2px; }

        .date-nav { display: flex; align-items: center; gap: 8px; }
        .date-nav a, .date-nav button {
            padding: 8px 14px; border-radius: 8px; font-size: 13px; font-weight: 600;
            text-decoration: none; border: 1.5px solid #e2e8f0;
            background: white; color: #374151; cursor: pointer; transition: all 0.2s;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .date-nav a:hover, .date-nav button:hover { border-color: #14b8a6; color: #14b8a6; }
        .date-nav .today-btn { background: #14b8a6; color: white; border-color: #14b8a6; }
        .date-nav .today-btn:hover { background: #0d9488; }
        .date-input {
            padding: 8px 12px; border: 1.5px solid #e2e8f0; border-radius: 8px;
            font-size: 13px; font-family: inherit; cursor: pointer;
            color: #374151; background: white;
        }
        .date-input:focus { outline: none; border-color: #14b8a6; }

        .btn-book {
            padding: 9px 18px; background: #14b8a6; color: white;
            border: none; border-radius: 8px; font-size: 13px; font-weight: 700;
            cursor: pointer; display: inline-flex; align-items: center; gap: 7px;
            text-decoration: none; transition: all 0.2s;
        }
        .btn-book:hover { background: #0d9488; transform: translateY(-1px); }

        /* ── Sheet Table ── */
        .sheet-card {
            background: white; border-radius: 14px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            overflow: hidden;
        }
        .sheet-table { width: 100%; border-collapse: collapse; }
        .sheet-table thead tr {
            background: #1e293b; color: white;
        }
        .sheet-table th {
            padding: 13px 16px; font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.06em;
            text-align: left; white-space: nowrap;
        }
        .sheet-table th:first-child { width: 100px; }

        .sheet-table tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: background 0.15s;
        }
        .sheet-table tbody tr:last-child { border-bottom: none; }
        .sheet-table tbody tr:hover { background: #f8fafc; }
        .sheet-table tbody tr.has-booking { background: #f0fdf4; }
        .sheet-table tbody tr.has-booking:hover { background: #dcfce7; }

        .sheet-table td {
            padding: 12px 16px; font-size: 14px;
            vertical-align: middle; color: #374151;
        }
        .time-cell {
            font-weight: 800; font-size: 15px; color: #0f172a;
            white-space: nowrap; width: 100px;
        }
        .empty-cell { color: #cbd5e1; font-size: 13px; font-style: italic; }

        /* Inline editable fields */
        .editable {
            background: transparent; border: none; font-size: 14px;
            font-family: inherit; color: #374151; width: 100%;
            padding: 4px 6px; border-radius: 6px; cursor: text;
            transition: all 0.15s;
        }
        .editable:hover { background: #f1f5f9; }
        .editable:focus { background: white; border: 1.5px solid #14b8a6; outline: none;
            box-shadow: 0 0 0 3px rgba(20,184,166,0.1); }
        select.editable { cursor: pointer; }

        /* Status badge */
        .status-pill {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700;
        }
        .status-scheduled  { background: #dbeafe; color: #1e40af; }
        .status-confirmed  { background: #d1fae5; color: #065f46; }
        .status-completed  { background: #e5e7eb; color: #374151; }
        .status-no-show    { background: #fef3c7; color: #92400e; }
        .status-cancelled  { background: #fee2e2; color: #991b1b; }

        /* Save indicator */
        .save-indicator {
            font-size: 11px; color: #10b981; font-weight: 600;
            display: none; margin-left: 6px;
        }
        .save-indicator.visible { display: inline; }

        /* Notes cell */
        .notes-cell textarea.editable {
            resize: none; min-height: 36px; max-height: 80px;
            overflow: hidden;
        }

        /* Empty day */
        .empty-day {
            padding: 48px; text-align: center; color: #94a3b8;
        }
        .empty-day i { font-size: 40px; display: block; margin-bottom: 12px; color: #cbd5e1; }

        /* Summary bar */
        .summary-bar {
            display: flex; gap: 16px; align-items: center;
            padding: 12px 20px; background: #f8fafc;
            border-bottom: 1px solid #e2e8f0; flex-wrap: wrap;
        }
        .summary-item { font-size: 13px; color: #64748b; display: flex; align-items: center; gap: 6px; }
        .summary-count { font-weight: 800; color: #0f172a; font-size: 16px; }

        @media (max-width: 900px) {
            .main { padding: 16px; }
            .sheet-table th:nth-child(5),
            .sheet-table td:nth-child(5) { display: none; }
            .navbar-menu { display: none; }
        }
    </style>
</head>
<body>

<x-staff-navbar />

<div class="main">

    {{-- Header --}}
    <div class="sheet-header">
        <div>
            <h1 class="sheet-title"><i class="bi bi-table" style="color:#14b8a6;"></i> Booking Sheet</h1>
            <p class="sheet-date-label">{{ $selectedDate->format('l, F j, Y') }}</p>
        </div>
        <div style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
            <div class="date-nav">
                <a href="{{ route('booking-sheet.index', ['date' => $selectedDate->copy()->subDay()->format('Y-m-d')]) }}">
                    <i class="bi bi-chevron-left"></i> Prev
                </a>
                <a href="{{ route('booking-sheet.index') }}" class="today-btn">Today</a>
                <a href="{{ route('booking-sheet.index', ['date' => $selectedDate->copy()->addDay()->format('Y-m-d')]) }}">
                    Next <i class="bi bi-chevron-right"></i>
                </a>
            </div>
            <input type="date" class="date-input" value="{{ $selectedDate->format('Y-m-d') }}"
                onchange="window.location='{{ route('booking-sheet.index') }}?date='+this.value">
            <a href="{{ route('appointments.book') }}?date={{ $selectedDate->format('Y-m-d') }}" class="btn-book">
                <i class="bi bi-plus-circle"></i> Book Appointment
            </a>
        </div>
    </div>

    {{-- Summary Bar --}}
    @php $booked = $appointments->count(); @endphp
    <div class="sheet-card" style="margin-bottom:16px;">
        <div class="summary-bar">
            <div class="summary-item">
                <span class="summary-count">{{ $booked }}</span> / {{ count($timeSlots) }} slots booked
            </div>
            <div class="summary-item">
                <span style="width:10px;height:10px;border-radius:50%;background:#d1fae5;display:inline-block;"></span>
                {{ $appointments->where('status','confirmed')->count() }} Confirmed
            </div>
            <div class="summary-item">
                <span style="width:10px;height:10px;border-radius:50%;background:#dbeafe;display:inline-block;"></span>
                {{ $appointments->where('status','scheduled')->count() }} Scheduled
            </div>
            <div class="summary-item">
                <span style="width:10px;height:10px;border-radius:50%;background:#fef3c7;display:inline-block;"></span>
                {{ $appointments->where('status','no-show')->count() }} No-show
            </div>
            @if($booked < count($timeSlots))
            <div class="summary-item" style="margin-left:auto;">
                <span style="color:#14b8a6; font-weight:700;">{{ count($timeSlots) - $booked }} slots available</span>
            </div>
            @endif
        </div>
    </div>

    {{-- Main Sheet --}}
    <div class="sheet-card">
        <table class="sheet-table">
            <thead>
                <tr>
                    <th><i class="bi bi-clock"></i> TIME</th>
                    <th><i class="bi bi-person"></i> OWNER</th>
                    <th><i class="bi bi-scissors"></i> PACKAGE / SERVICE</th>
                    <th><i class="bi bi-rulers"></i> SIZE</th>
                    <th><i class="bi bi-chat-left-text"></i> NOTES</th>
                    <th><i class="bi bi-circle-half"></i> STATUS</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($timeSlots as $slot => $label)
                    @php $appt = $appointments->get($slot); @endphp
                    <tr class="{{ $appt ? 'has-booking' : '' }}">
                        {{-- Time --}}
                        <td class="time-cell">{{ $label }}</td>

                        @if($appt)
                            {{-- Owner --}}
                            <td>
                                <div style="font-weight:700; color:#0f172a;">
                                    {{ $appt->patient->owner_name ?? '—' }}
                                </div>
                                <div style="font-size:12px; color:#64748b;">
                                    {{ $appt->patient->pet_name ?? '' }}
                                    @if($appt->patient->breed) · {{ $appt->patient->breed }} @endif
                                </div>
                                @if($appt->patient->owner_contact)
                                    <div style="font-size:11px; color:#94a3b8;">
                                        <i class="bi bi-telephone"></i> {{ $appt->patient->owner_contact }}
                                    </div>
                                @endif
                            </td>

                            {{-- Package / Service --}}
                            <td>
                                <select class="editable" data-field="service_type" data-id="{{ $appt->id }}" onchange="saveField(this)">
                                    <option value="">— Select —</option>
                                    @foreach($services as $svc)
                                        <option value="{{ $svc->name }}" {{ $appt->service_type === $svc->name ? 'selected' : '' }}>
                                            {{ $svc->name }}
                                        </option>
                                    @endforeach
                                    <option value="{{ $appt->service_type }}" {{ !$services->pluck('name')->contains($appt->service_type) && $appt->service_type ? 'selected' : '' }}>
                                        {{ $appt->service_type }}
                                    </option>
                                </select>
                            </td>

                            {{-- Size --}}
                            <td>
                                <select class="editable" data-field="notes" data-id="{{ $appt->id }}" onchange="saveSizeField(this, {{ $appt->id }})">
                                    <option value="">—</option>
                                    @foreach(['XS','S','M','L','XL','G (Giant)'] as $sz)
                                        @php
                                            $currentSize = '';
                                            if(preg_match('/\b(XS|S|M|L|XL|G\s?\(Giant\)|Giant)\b/i', $appt->notes ?? '', $m)) {
                                                $currentSize = strtoupper(trim($m[0]));
                                            }
                                        @endphp
                                        <option value="{{ $sz }}" {{ strtoupper(trim($currentSize)) === strtoupper(trim($sz)) ? 'selected' : '' }}>
                                            {{ $sz }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>

                            {{-- Notes --}}
                            <td class="notes-cell">
                                <textarea class="editable" rows="1"
                                    data-field="notes" data-id="{{ $appt->id }}"
                                    onblur="saveField(this)"
                                    oninput="autoResize(this)"
                                    placeholder="Add notes...">{{ $appt->notes ?? '' }}</textarea>
                            </td>

                            {{-- Status --}}
                            <td>
                                <select class="editable" data-field="status" data-id="{{ $appt->id }}" onchange="saveField(this)">
                                    <option value="scheduled"  {{ $appt->status === 'scheduled'  ? 'selected' : '' }}>Scheduled</option>
                                    <option value="confirmed"  {{ $appt->status === 'confirmed'  ? 'selected' : '' }}>Confirmed</option>
                                    <option value="completed"  {{ $appt->status === 'completed'  ? 'selected' : '' }}>Completed</option>
                                    <option value="no-show"    {{ $appt->status === 'no-show'    ? 'selected' : '' }}>No-show</option>
                                    <option value="cancelled"  {{ $appt->status === 'cancelled'  ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </td>

                            {{-- Actions --}}
                            <td>
                                <div style="display:flex; gap:6px;">
                                    <a href="{{ route('appointments.edit', $appt) }}"
                                        style="padding:5px 10px; background:#eff6ff; color:#1e40af; border-radius:6px; font-size:12px; font-weight:600; text-decoration:none;">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <span class="save-indicator" id="saved-{{ $appt->id }}">✓ Saved</span>
                                </div>
                            </td>

                        @else
                            {{-- Empty slot --}}
                            <td colspan="5" class="empty-cell">— Available —</td>
                            <td></td>
                            <td>
                                <a href="{{ route('appointments.book') }}?time={{ $slot }}&date={{ $selectedDate->format('Y-m-d') }}"
                                    style="padding:5px 10px; background:#f0fdf4; color:#16a34a; border-radius:6px; font-size:12px; font-weight:600; text-decoration:none; white-space:nowrap;">
                                    <i class="bi bi-plus"></i> Book
                                </a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

async function saveField(el) {
    const id    = el.dataset.id;
    const field = el.dataset.field;
    const value = el.value;

    try {
        const res = await fetch(`/booking-sheet/${id}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ [field]: value }),
        });

        if (res.ok) {
            const indicator = document.getElementById(`saved-${id}`);
            if (indicator) {
                indicator.classList.add('visible');
                setTimeout(() => indicator.classList.remove('visible'), 2000);
            }
            // Update row style if status changed
            if (field === 'status' && value === 'cancelled') {
                el.closest('tr').classList.remove('has-booking');
            }
        }
    } catch (e) {
        console.error('Save failed:', e);
    }
}

// Size is stored as part of notes — prepend/replace size tag
function saveSizeField(el, id) {
    const size  = el.value;
    const notesEl = document.querySelector(`textarea[data-id="${id}"]`);
    let notes = notesEl ? notesEl.value : '';

    // Remove existing size tag if present
    notes = notes.replace(/\[Size:\s*[^\]]+\]/gi, '').trim();

    // Prepend new size
    if (size) {
        notes = `[Size: ${size}] ${notes}`.trim();
        if (notesEl) notesEl.value = notes;
    }

    // Save updated notes
    const fakeEl = { dataset: { id, field: 'notes' }, value: notes };
    saveField(fakeEl);
}

function autoResize(el) {
    el.style.height = 'auto';
    el.style.height = el.scrollHeight + 'px';
}

// Auto-resize all textareas on load
document.querySelectorAll('textarea.editable').forEach(autoResize);
</script>
</body>
</html>