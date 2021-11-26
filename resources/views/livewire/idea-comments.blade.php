<div
     class="relative pt-4 my-8 mt-1 space-y-6 comments-container md:ml-22">

  @foreach ($comments as $comment)
    <livewire:idea-comment :key="$comment->id"
                           :comment="$comment"
                           :ideaUserId="$idea->user->id" />
  @endforeach
  <div class="my-8">
    {{ $comments->links() }}
  </div>

</div>
