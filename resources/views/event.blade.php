<x-layout>
    <x-slot name="title">
       {{ $title }}
    </x-slot>
    <x-slot name="commentaire">
        {{ $commentaire }}
    </x-slot>
    <div class="js-calendar">
        <H2 class="text-white-600 js-calendar">Choisir la date d'envoi de votre mail</H2>
        <livewire:calendar :minDate="$minDate" :maxDate="$maxDate" :unavailableDate="$unavailableDate" />
    </div>
    <div class="js-form hidden">
        <livewire:form-selected :eventId="$event_id"/>
    </div>

    @push('scripts')
    <script>
        let dateIsSelected = false
        Livewire.on('dateSelected', dateJour => {
            document.querySelector('.js-form').classList.remove('hidden')
            document.querySelector('.js-calendar').classList.add('hidden')
            dateIsSelected = true
        })
        Livewire.on('formeSubmited', x => {
            window.location.reload(true);
        })
        window.history.pushState(null, null, window.location.pathname);
        window.addEventListener('popstate', (event) => {
            if(!dateIsSelected)history.back()
            else window.location.reload(true)
        })

    </script>
    @endpush
</x-layout>