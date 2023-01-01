<x-app-layout>
  

  <div class="py-12 flex justify-center">
    <div class="max-w-2xl px-4">
      <div class="bg-white overflow-hidden shadow-sm rounded-lg ">
        <div class="border-b border-gray-200 bg-gray-200">
          <div class="mb-6">

            <div class="flex flex-col mb-4">
              <img class = "transition duration-300 drop-shadow-md"src=" {{ asset('storage/'.$review->imgpath)}}">
            </div>
          <div class="px-6">
            <div class="flex flex-col mb-2">
              <p class="my-2  font-bold text-xl text-grey-darkest text-center">{{$review->title}}</p>
            </div>

            <div class="flex flex-col mb-4 overflow-auto">
              <p class="text-grey-darkest text-gray-700 text-center" id="description">
                {{$review->description}}
              </p>
            </div>

            <div class="flex justify-around">
              @foreach($review->tags as $tag)
              @if($tag->name == '北海道' || $tag->name == '東北' || $tag->name == '関東' || $tag->name == '関西' || $tag->name == '中国・四国' || $tag->name == '九州・沖縄')
              <div class="flex flex-col mb-4 text-center">
                <p class="mb-2 uppercase font-bold sm:text-lg text-grey-darkest">エリア</p>
                <p class=" text-gray-700">
                  {{$tag->name}}
                </p>
              </div>

              <div>
                <div class="flex flex-col mb-4 text-center">
                  <p class="mb-2 uppercase font-bold sm:text-lg text-grey-darkest">おすすめ度</p>
                  <p class=" text-yellow-500">
                      @if($review->score == 1)
                      {{$review->score = '★'}}
                      @endif

                      @if($review->score == 2)
                      {{$review->score = '★★'}}
                      @endif

                      @if($review->score == 3)
                      {{$review->score = '★★★'}}
                      @endif

                      @if($review->score == 4)
                      {{$review->score = '★★★★'}}
                      @endif

                      @if($review->score == 5)
                      {{$review->score = '★★★★★'}}
                      @endif
                  </p>
                </div>
              </div>
              @endif
              @endforeach
            </div>
            
            <!-- <div class="flex flex-col mb-4 overflow-auto">
              <p class=" font-bold text-xl text-grey-darkest text-center">タグ</p>
              <p class="text-grey-darkest text-gray-700 text-center" id="description">
                {{$review->description}}
              </p>
            </div> -->

            <button href="{{ route('review.index') }}" class="block text-center w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-red-400 shadow-lg focus:outline-none  hover:shadow-none" type = "button" onClick="history.back();">
              戻る
            </button>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  
</x-app-layout>

