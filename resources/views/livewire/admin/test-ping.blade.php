<div class="card mt-3">
    <div class="card-body">
        <h5 class="card-title mb-2">Livewire Ajax Check</h5>

        <p class="mb-1">Count: <strong>{{ $count }}</strong></p>
        <p class="text-muted mb-3">{{ $lastAction }}</p>

        <button wire:click="increment" wire:loading.attr="disabled" class="btn btn-primary">
            <span wire:loading.remove wire:target="increment">+1</span>
            <span wire:loading wire:target="increment">Loading...</span>
        </button>
    </div>
</div>