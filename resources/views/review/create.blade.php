<!-- resources/views/tweet/create.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Create New Tweet') }}
    </h2>
  </x-slot>

  <!-- <form class="" action="{{ route('review.store') }}" method="POST"> -->
    <div class="py-12 flex">
        <!-- <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12 flex justify-center items-end">
          <div>
            <form method="POST" action="/upload" enctype="multipart/form-data">
              @csrf
              <input type="file" name="image" value ="">
            </form>
          </div>

        </div> -->


      <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            @include('common.errors')
            <form class="mb-6" action="{{ route('review.store') }}" method="POST">
              @csrf
              <div class="flex flex-col mb-4">
                <label class="mb-2 uppercase font-mono text-lg text-grey-darkest" for="tweet">施設名</label>
                <input class="border py-2 px-3 text-grey-darkest" type="text" name="title" id="title">
              </div>
              <div class="flex flex-col mb-4">
                <label class="mb-2 uppercase font-mono text-lg text-grey-darkest" for="description">レビュー</label>
                <input class="border py-2 px-3 text-grey-darkest" type="text" name="description" id="description">
              </div>

              <div class="flex flex-col mb-4">
                <label class="mb-2 uppercase font-mono text-lg text-grey-darkest" for="description">おすすめ度</label>
                <select class="border py-2 px-3 text-grey-darkest" type="text" name="description" id="description">
                  <option class=" " value="">選択して下さい</option>
                  <option class="text-yellow-400" value="1">★</option>
                  <option value="2">★★</option>
                  <option value="3">★★★</option>
                  <option value="4">★★★★</option>
                  <option value="5">★★★★★</option>
                </select>
              </div>

              <button type="submit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                Create
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  <!-- </form> -->
</x-app-layout>

