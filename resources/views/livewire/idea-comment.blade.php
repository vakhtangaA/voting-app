<div
  class="@if ($comment->is_status_update) is-status-update {{ 'status-' . Str::kebab($comment->status->name) }}@endif comment-container relative bg-white rounded-xl flex transition duration-500 ease-in mt-4"
>
  <div class="flex flex-1 px-4 py-6">
    <div class="flex-none">
      <a href="#">
        <img
          src="{{ $comment->user->getAvatar() }}"
          alt="avatar"
          class="w-14 h-14 rounded-xl"
        >
      </a>
      @if ($comment->user->isAdmin())
        <div
          class="md:text-center uppercase text-blue text-xxs font-bold mt-1"
        >Admin</div>
      @endif
    </div>
    <div class="w-full mx-4">

      <div class="text-gray-600 line-clamp-3">
        @admin
        @if ($comment->spam_reports > 0)
          <div class="text-red mb-2">Spam Reports:
            {{ $comment->spam_reports }}</div>
        @endif
        @endadmin
        @if ($comment->is_status_update)
          <h4 class="text-xl font-semibold mb-3">
            Status Changed to "{{ $comment->status->name }}"
          </h4>
        @endif

        <div class="mt-4 md:mt-0">
          {{ $comment->body }}
        </div>
      </div>

      @auth
        <div
          x-cloak
          class="flex items-center justify-between mt-6"
          x-data="{isOpen: false}"
        >
          <div
            class=" flex items-center space-x-2 text-xs font-semibold text-gray-400"
          >
            <div
              class="@if ($comment->is_status_update) text-blue @endif font-bold text-gray-900"
            >
              {{ $comment->user->name }}</div>
            <div>&bull;</div>
            @if ($comment->user->id === $ideaUserId)
              <div class="text-blue">OP</div>
              <div>&bull;</div>
            @endif
            <div>{{ $comment->created_at->diffForHumans() }}</div>
          </div>
          <div class="text-gray-900  flex items-center space-x-2">
            <button
              @click="isOpen = !isOpen"
              class="relative px-3 py-2 transition duration-150 ease-in bg-gray-100 border rounded-full hover:bg-gray-200 h-7"
            >
              <svg
                fill="currentColor"
                width="24"
                height="6"
              >
                <path
                  d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z"
                  style="color: rgba(163, 163, 163, .5)"
                >
              </svg>
              <ul
                style="display: none;"
                x-show.transation.origin.top.left="isOpen"
                @click.away="isOpen = false"
                @keydown.escape.window="isOpen = false"
                class="absolute right-0 z-20 py-3 font-semibold text-left bg-white md:ml-8 w-44 shadow-dialog rounded-xl top-8 lg:top-6 lg:left-0"
              >
                @can('update', $comment)
                  <li>
                    <a
                      href="#"
                      @click="Livewire.emit('setEditComment', {{ $comment->id }})"
                      class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100"
                    >Edit Comment</a>
                  </li>
                @endcan
                @can('delete', $comment)
                  <li>
                    <a
                      href="#"
                      @click="Livewire.emit('setDeleteComment', {{ $comment->id }}) "
                      class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100"
                    >Delete Comment
                    </a>
                  </li>
                @endcan
                <li>
                  <a
                    href="#"
                    @click.prevent="
                                                    isOpen = false
                                                    Livewire.emit('setMarkAsSpamComment', {{ $comment->id }})
                                                "
                    class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                  >
                    Mark as Spam
                  </a>
                </li>

                @admin
                @if ($comment->spam_reports > 0)
                  <li>
                    <a
                      href="#"
                      @click.prevent="
                                                        isOpen = false
                                                        Livewire.emit('setMarkAsNotSpamComment', {{ $comment->id }})
                                                    "
                      class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                    >
                      Not Spam
                    </a>
                  </li>
                @endif
                @endadmin
              </ul>
            </button>
          </div>
        </div>
      @endauth
    </div>
  </div>
</div>
