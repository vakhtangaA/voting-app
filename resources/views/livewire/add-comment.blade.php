<div x-cloak
     x-init="
        window.livewire.on('commentWasAdded', () => {
            isOpen = false
        })
    "
     class="relative"
     x-data="{isOpen: false}">
  <button type="button"
          @click="isOpen = !isOpen"
          class="flex items-center justify-center w-32 px-6 py-3 text-sm font-semibold text-white transition duration-150 ease-in border h-11 bg-blue rounded-xl border-blue hover:bg-blue-hover">
    Reply
  </button>
  <div style="display: none;"
       x-show.transation.origin.top.left="isOpen"
       @click.away="isOpen = false"
       @keydown.escape.window="isOpen = false"
       class="absolute z-10 w-64 mt-2 text-sm font-semibold text-left bg-white md:w-104 shadow-dialog rounded-xl">
    @auth
      <form wire:submit.prevent='addComment'
            action="#"
            class="px-4 py-6 space-y-4">
        <div>
          <textarea wire:model='comment'
                    name="post_comment"
                    id="post_comment"
                    cols="30"
                    rows="4"
                    class="w-full px-4 py-2 text-sm placeholder-gray-900 bg-gray-100 border-none rounded-xl"
                    placeholder="Go ahead, don't be shy. Share your thoughts..."></textarea>
          @error('comment')
            <p class="text-red text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="flex items-center space-x-3">
          <button type="submit"
                  class="flex items-center justify-center w-1/2 px-6 py-3 text-sm font-semibold text-white transition duration-150 ease-in border h-11 bg-blue rounded-xl border-blue hover:bg-blue-hover">
            Post Comment
          </button>
          <button type="button"
                  class="flex items-center justify-center w-32 px-6 py-3 text-xs font-semibold transition duration-150 ease-in bg-gray-200 border border-gray-200 h-11 rounded-xl hover:border-gray-400">
            <svg class="w-4 text-gray-600 transform -rotate-45"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
              <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
            </svg>
            <span class="ml-1">Attach</span>
          </button>
        </div>

      </form>
    @else
      <div class="px-4 py-6">
        <p class="font-normal">Please login or create an account to
          post a comment.</p>
        <div class="flex items-center space-x-3 mt-8">
          <a href="{{ route('login') }}"
             class="w-1/2 h-11 text-sm text-center bg-blue text-white font-semibold rounded-xl hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
            Login
          </a>
          <a href="{{ route('register') }}"
             class="flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
            Sign Up
          </a>
        </div>
      </div>
    @endauth
  </div>
</div>
