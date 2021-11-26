@can('update', $idea)
  <livewire:edit-idea :idea="$idea" />
@endcan

@can('delete', $idea)
  <livewire:delete-idea :idea="$idea" />
@endcan

@auth
  <livewire:mark-idea-as-spam :idea="$idea" />
@endauth


@auth
  <livewire:edit-comment />
@endauth
