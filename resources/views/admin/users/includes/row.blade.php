<x-livewire-tables::bs4.table.cell>
    <img class="c-avatar-img" style="width: 2.25rem;" src="{{ $row->profile_photo_url }}"></img>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <a href="mailto:{{ $row->email }}">{{ $row->email }}</a>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @include('admin.users.includes.actions', ['user' => $row])
</x-livewire-tables::bs4.table.cell>
