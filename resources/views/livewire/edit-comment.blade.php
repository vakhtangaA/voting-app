<div
  style="display: none"
  x-init="
        Livewire.on('commentWasUpdated', () => {
         isOpen = false;
       })
        Livewire.on('editCommentWasSet', () => {
         isOpen = true;
       })
     "
  x-data="{ isOpen: false }"
  x-show="isOpen"
  @keydown.escape.window="isOpen = false"
  class="fixed inset-0 z-10 overflow-y-auto"
  aria-labelledby="modal-title"
  role="dialog"
  aria-modal="true"
>
  <div class="flex items-end justify-center min-h-screen ">
    <div
      x-show.transition.opacity="isOpen"
      class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"
      aria-hidden="true"
    >
    </div>
    <div
      x-show.transition.opacity.origin.bottom.duration.400ms="isOpen"
      class="px-4 py-4 pt-5 pb-4 overflow-hidden transition-all transform bg-white rounded rounded-tl-xl-tr-xl modal sm:max-w-lg sm:w-full"
    >

      <div class="absolute top-0 right-0 pt-4 pr-4">
        <button
          @click="isOpen=false"
          class="text-gray-400 hover:text-gray-600"
        >
          <svg
            class="w-6 h-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              strokeLinecap="round"
              strokeLinejoin="round"
              strokeWidth={2}
              d="M6 18L18 6M6 6l12 12"
            />
          </svg>
        </button>
      </div>

      <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
        <h3 class="text-lg text-center ">Edit Comment</h3>
        <form
          wire:submit.prevent="updateComment"
          action="#"
          method="POST"
          class="px-4 py-6 space-y-4"
        >
          <div>
            <textarea
              x-ref="editComment"
              wire:model.defer="body"
              name="idea"
              cols="30"
              rows="4"
              class="w-full bg-gray-100 rounded-xl border-none placeholder-gray-900 text-sm px-4 py-2"
              placeholder="Type your comment here"
              required
            ></textarea>
            @error('body')
              <p class="mt-1 text-xs text-red">
                {{ $message }}</p>
            @enderror
          </div>
          <div class="flex items-center justify-between space-x-3">
            <button
              type="button"
              class="flex items-center justify-center w-1/2 px-6 py-3 text-xs font-semibold transition duration-150 ease-in bg-gray-200 border border-gray-200 h-11 rounded-xl hover:border-gray-400"
            >
              <svg
                class="w-4 text-gray-600 transform -rotate-45"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"
                />
              </svg>
              <span class="ml-1">Attach</span>
            </button>
            <button
              type="submit"
              class="flex items-center justify-center w-1/2 px-6 py-3 text-xs font-semibold text-white transition duration-150 ease-in border h-11 bg-blue rounded-xl border-blue hover:bg-blue-hover"
            >
              <span class="ml-1">Update</span>
            </button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
