<div>
  <div class="flex flex-col space-y-3 md:space-x-6 md:space-y-0 md:flex-row filters">
    <div class="w-full md:w-1/3">
      <select name="category" id="category" class="w-full px-4 py-2 border-none rounded-xl">
        <option value="Cateogory One">Category One</option>
        <option value="Cateogory Two">Category Two</option>
        <option value="Cateogory Three">Category Three
        </option>
      </select>
    </div>
    <div class="w-full md:w-1/3">
      <select name="other_category" id="other_category"
        class="w-full px-4 py-2 border-none rounded-xl">
        <option value="Cateogory One">Category One</option>
        <option value="Cateogory Two">Category Two</option>
        <option value="Cateogory Three">Category Three
        </option>
      </select>
    </div>
    <div class="relative w-full md:w-2/3">
      <input type="search" placeholder="Find an idea"
        class="w-full px-4 py-2 pl-8 bg-white border-none rounded-xl placeholder:text-red-900">
      <div class="absolute top-0 flex h-full ml-2 itmes-center">
        <svg class="w-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
      </div>
    </div>
  </div> <!-- end filters -->
  <div class="my-6 space-y-6 ideas-container">
    @foreach ($ideas as $idea)
    <livewire:idea-index :idea="$idea" :key="$idea->id" :votesCount="$idea->votes_count" />
    @endforeach
  </div> <!-- end ideas-container -->
  <div class="my-8">
    {{ $ideas->appends(request()->query())->links() }}
  </div>
</div>