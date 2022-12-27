<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Review Detail') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="mb-6">

            <div class="flex flex-col mb-4">
              <img class = "transition duration-300 drop-shadow-md"src=" {{ asset('storage/'.$review->imgpath)}}">
            </div>

            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">施設名</p>
              <p class="py-2 px-3 text-grey-darkest" id="tweet">
                {{$review->title}}
              </p>
            </div>

            @foreach($review->tags as $tag)
            @if($tag->name == '北海道' || $tag->name == '東北' || $tag->name == '関東' || $tag->name == '関西' || $tag->name == '中国・四国' || $tag->name == '九州・沖縄')
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">エリア</p>
              <p class="py-2 px-3 text-grey-darkest" id="tweet">
                {{$tag->name}}
              </p>
            </div>
            @endif
            @endforeach
            <div class="flex flex-col mb-4 overflow-auto">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">説明、レビュー</p>
              <p class="py-2 px-3 text-grey-darkest" id="description">
                {{$review->description}}
              </p>
            </div>
            <a href="{{ route('review.index') }}" class="block text-center w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-red-400 shadow-lg focus:outline-none  hover:shadow-none">
              戻る
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

