<div
     class="relative pt-4 my-8 mt-1 space-y-6 comments-container md:ml-22">

  @forelse ($idea->comments as $comment)
    <livewire:idea-comment :key="$comment->id"
                           :comment="$comment"
                           :ideaUserId="$idea->user->id" />
  @empty
    <p>
      No Comments yet..
    </p>
  @endforelse

</div>
