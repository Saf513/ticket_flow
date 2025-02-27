<div class="alert alert-{{ $type ?? 'info' }} p-4 rounded-lg bg-{{ $type == 'danger' ? 'red' : 'green' }}-500 text-white">
    <strong>{{ $title ?? 'Alert' }}:</strong> {{ $message }}
</div>
