<x-app-layout>
  <div>
    <a href="{{ $backUrl }}" class="flex items-center font-semibold hover:underline">
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
      <span class="ml-2">All ideas(or back to chosen categories with filters)</span>
    </a>
  </div>

  <livewire:idea-show :idea="$idea" :votesCount="$votesCount" />

  @can('update', $idea)
  <livewire:edit-idea :idea="$idea" />
  @endcan
  
  @can('delete', $idea)
  <livewire:delete-idea :idea="$idea" />
  @endcan

  <livewire:mark-idea-as-spam :idea="$idea" />



  <div class="relative pt-4 my-8 mt-1 space-y-6 comments-container md:ml-22">
    <div class="relative flex mt-4 bg-white comment-container rounded-xl">
      <div class="flex flex-1 px-4 py-6">
        <div class="flex-none">
          <a href="#">
            <img src="https://avatars.dicebear.com/api/male/john.svg?background=%230000ff"
              alt="avatar" class="w-14 h-14 rounded-xl">
          </a>
        </div>
        <div class="w-full mx-4">
          <h4 class="text-xl font-semibold">
            <a href="#" class="hover:underline">A random title can go here</a>
          </h4>
          <div class="mt-3 text-gray-600 line-clamp-3">
            Lorem ipsum dolor sit amet consectetur.
          </div>

          <div x-cloak class="flex items-center justify-between mt-6" x-data="{isOpen: false}">
            <div class="flex items-center space-x-2 text-xs font-semibold text-gray-400">
              <div class="font-bold text-gray-900">John Doe</div>
              <div>&bull;</div>
              <div>10 hours ago</div>
            </div>
            <div class="flex items-center space-x-2">
              <button @click="isOpen = !isOpen"
                class="relative px-3 py-2 transition duration-150 ease-in bg-gray-100 border rounded-full hover:bg-gray-200 h-7">
                <svg fill="currentColor" width="24" height="6">
                  <path
                    d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z"
                    style="color: rgba(163, 163, 163, .5)">
                </svg>
                <ul x-cloak x-show.transation.origin.top.left="isOpen" @click.away="isOpen = false"
                  @keydown.escape.window="isOpen = false"
                  class="absolute right-0 z-10 py-3 font-semibold text-left bg-white w-44 shadow-dialog rounded-xl md:ml-8 md:top-6 md:left-0">
                  <li><a href="#"
                      class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">Mark
                      as Spam</a></li>
                  <li><a href="#"
                      class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">Delete
                      Post</a></li>
                </ul>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="relative flex mt-4 bg-white is-admin comment-container rounded-xl">
      <div class="flex flex-1 px-4 py-6">
        <div class="flex-none">
          <a href="#">
            <img src="https://avatars.dicebear.com/api/male/john.svg?background=%230000ff"
              alt="avatar" class="w-14 h-14 rounded-xl">
          </a>
          <div class="mt-1 font-bold text-center uppercase text-blue text-xxs">Admin</div>
        </div>
        <div class="w-full mx-4">
          <h4 class="text-xl font-semibold">
            <a href="#" class="hover:underline">Status Changed to "Under Construction"</a>
          </h4>
          <div class="mt-3 text-gray-600 line-clamp-3">
            Lorem ipsum dolor sit amet consectetur.
          </div>

          <div class="flex items-center justify-between mt-6">
            <div class="flex items-center space-x-2 text-xs font-semibold text-gray-400">
              <div class="font-bold text-blue">Andrea</div>
              <div>&bull;</div>
              <div>10 hours ago</div>
            </div>
            <div class="flex items-center space-x-2">
              <button
                class="relative px-3 py-2 transition duration-150 ease-in bg-gray-100 border rounded-full hover:bg-gray-200 h-7">
                <svg fill="currentColor" width="24" height="6">
                  <path
                    d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z"
                    style="color: rgba(163, 163, 163, .5)">
                </svg>
                <ul
                  class="absolute hidden py-3 ml-8 font-semibold text-left bg-white w-44 shadow-dialog rounded-xl">
                  <li><a href="#"
                      class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">Mark
                      as Spam</a></li>
                  <li><a href="#"
                      class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">Delete
                      Post</a></li>
                </ul>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="relative flex mt-4 bg-white comment-container rounded-xl">
      <div class="flex flex-1 px-4 py-6">
        <div class="flex-none">
          <a href="#">
            <img src="https://avatars.dicebear.com/api/male/john.svg?background=%230000ff"
              alt="avatar" class="w-14 h-14 rounded-xl">
          </a>
        </div>
        <div class="w-full mx-4">
          <h4 class="text-xl font-semibold">
            <a href="#" class="hover:underline">Holal comment</a>
          </h4>
          <div class="mt-3 text-gray-600 line-clamp-3">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis perspiciatis id maxime
            obcaecati! Minus et quisquam totam quasi,
          </div>

          <div class="flex items-center justify-between mt-6">
            <div class="flex items-center space-x-2 text-xs font-semibold text-gray-400">
              <div class="font-bold text-gray-900">{{ $idea->user->name }}</div>
              <div>&bull;</div>
              <div>{{ $idea->created_at->diffForHumans() }}</div>
            </div>
            <div class="flex items-center space-x-2">
              <button
                class="relative px-3 py-2 transition duration-150 ease-in bg-gray-100 border rounded-full hover:bg-gray-200 h-7">
                <svg fill="currentColor" width="24" height="6">
                  <path
                    d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z"
                    style="color: rgba(163, 163, 163, .5)">
                </svg>
                <ul
                  class="absolute hidden py-3 ml-8 font-semibold text-left bg-white w-44 shadow-dialog rounded-xl">
                  <li><a href="#"
                      class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">Mark
                      as Spam</a></li>
                  <li><a href="#"
                      class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">Delete
                      Post</a></li>
                </ul>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>