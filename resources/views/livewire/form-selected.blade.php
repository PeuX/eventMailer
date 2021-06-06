<div>
    <form wire:submit.prevent="save">
        <textarea wire:model.defer="commentaire" class="w-full h-40" placeholder="Le petit message à envoyer aux futures mariées..."></textarea><br>
        <span>La petite photo qui fait plaisir 😜</span></br>
        @if ($photo)
            Photo Preview:
            <img class="max-w-screen-lg max-h-52" src="{{ $photo->temporaryUrl() }}"><br>
        @endif
        <div class="w-full text-center block my-1" wire:loading wire:target="photo">Téléchargement...<br></div>
        <input type="file" accept="image/*" wire:model="photo"><br>
        @error('photo') <span class="error text-white bg-red-500 w-full text-center block my-1">{{ $message }}</span> @enderror

        <button wire:loading.remove wire:target="save" type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Et on reserve pour envoi @if ($date) le {{ $date->jour }} @endif !</button>
        <div wire:loading wire:target="save" class="w-full text-center block my-1">
            Sauvegarde...
        </div>
    </form>
</div>
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('component.initialized', (component) => {})
    }
</script>
@endpush