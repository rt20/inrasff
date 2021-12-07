<div class="bi-timeline">
    @foreach ($history as $item)
        <div class="bi-timeline-item">
            <div class="bi-timeline-date">{{ $item->date }}</div>
            <div class="bi-timeline-msg">{{ $item->message }}</div>
        </div>
    @endforeach
</div>