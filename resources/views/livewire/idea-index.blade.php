<div
  x-data
  @click="
        const clicked = $event.target;
        const target = clicked.tagName.toLowerCase()

        const ignores = ['button', 'svg', 'path', 'a']

        if (!ignores.includes(target)) {
          clicked.closest('.idea-container').querySelector('.idea-link').click()
        }
        "
  class="flex transition duration-150 ease-in bg-white cursor-pointer idea-container hover:shadow-card rounded-xl"
>
  <div class="hidden px-5 py-8 border-r border-gray-100 md:block">
    <div class="text-center">
      <div class="text-2xl font-semibold">{{ $votesCount }}</div>
      <div class="text-gray-500">Votes</div>
    </div>

    <div class="mt-8">
      @if ($hasVoted)
        <button
          wire:click.prevent="vote"
          class="w-20 px-4 py-3 font-bold text-white uppercase transition duration-150 ease-in border bg-blue border-blue text-xxs rounded-xl hover:border-blue"
        >
          Voted
        </button>
      @else
        <button
          wire:click.prevent="vote"
          class="w-20 px-4 py-3 font-bold uppercase transition duration-150 ease-in bg-gray-200 border border-gray-200 text-xxs rounded-xl hover:border-gray-400"
        >
          Vote
        </button>
      @endif
    </div>
  </div>
  <div class="flex flex-col flex-1 px-2 py-6 md:flex-row">
    <div class="flex-none mx-4 md:mx-0">
      <a href="#">
        <img
          src="{{ $idea->user->getAvatar() }}"
          alt="avatar"
          class="w-14 h-14 rounded-xl"
        />
      </a>
    </div>
    <div class="flex flex-col justify-between w-full mx-4">
      <h4 class="text-xl font-semibold">
        <a
          href="{{ route('idea.show', $idea) }}"
          class="hover:underline idea-link"
        >{{ $idea->title }}</a>
      </h4>
      <div class="mt-3 text-gray-600 line-clamp-3">
        @admin @if ($idea->spam_reports > 0)
          <div class="mb-2 text-red">Spam Reports:
            {{ $idea->spam_reports }}</div>
        @endif @endadmin
        {{ $idea->description }}
      </div>

      <div
        class="flex flex-col justify-between mt-6 md:items-center md:flex-row"
      >
        <div
          class="flex items-center space-x-2 text-xs font-semibold text-gray-400 "
        >
          <div>
            {{ $idea->created_at->diffForHumans() }}
          </div>
          <div>&bull;</div>
          <div>{{ $idea->category->name }}</div>
          <div>&bull;</div>
          <div
            wire:ignore
            class="text-gray-900"
          >{{ $idea->comments_count }} comments</div>
        </div>
        <div
          class="flex items-center mt-2 space-x-2 md:mt-0"
          x-data="{ isOpen: false }"
        >
          <div
            class="{{ 'status-' . Str::kebab($idea->status->name) }} text-xxs font-bold uppercase leading-none rounded-full text-center  h-7 py-2 px-4 w-auto"
          >{{ $idea->status->name }}</div>
        </div>
        <div class="flex items-center mt-4 md:hidden md:mt-0">
          <div
            class="h-10 px-4 py-2 pr-8 text-center bg-gray-100 rounded-xl"
          >
            <div class="text-sm font-bold leading-none">
              {{ $votesCount }}
            </div>
            <div
              class="font-semibold leading-none text-gray-400 text-xxs"
            >
              Votes
            </div>
          </div>
          @if ($hasVoted)
            <button
              wire:click.prevent="vote"
              class="w-20 px-4 py-3 font-bold text-white uppercase transition duration-150 ease-in border bg-blue border-blue text-xxs rounded-xl hover:border-blue"
            >
              Voted
            </button>
          @else
            <button
              wire:click.prevent="vote"
              class="w-20 px-4 py-3 font-bold uppercase transition duration-150 ease-in bg-gray-200 border border-gray-200 text-xxs rounded-xl hover:border-gray-400"
            >
              Vote
            </button>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end idea-container -->
