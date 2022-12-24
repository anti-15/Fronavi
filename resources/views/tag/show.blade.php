<x-app-layout>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-4 bg-white border-b border-gray-200">
          @foreach($TagReviews as $tag)
          @foreach($tag -> tags as $ts)
            <div class="flex  justify-center mb-4">
              <!-- <p class="py-2 px-6 text-white text-center bg-red-300 rounded-full text-3xl  font-ShipporiMincho" >
                # {{$ts->name}}
              </p> -->

              <a class=" py-2 px-6 text-xl font-medium tracking-widest text-white  bg-red-300 shadow-lg rounded-full focus:outline-none duration-200 transition-all">
                  #{{$ts->name}}
              </a>
            </div>
            @endforeach
            @break
            @endforeach
          <table class="text-center w-full border-collapse">
            <thead>

            <div class="text-right sm:flex justify-end sm:space-x-1">
              <form class="" action="{{ route('review.index') }}" method="GET">
                @csrf
                <button type="submit" class=" py-1 px-3 text-xs font-medium tracking-widest text-white  bg-red-300 shadow-lg rounded-full focus:outline-none duration-200 transition-all hover:bg-red-500 hover:shadow-none">
                  新しい順
                </button>
              </form>

              <form class="mb-6" action="{{ route('review.score') }}" method="GET">
                @csrf
                <button type="submit" class=" py-1 px-3  text-xs font-medium tracking-widest text-white  bg-red-300 shadow-lg rounded-full focus:outline-none duration-200 transition-all hover:bg-red-500 hover:shadow-none">
                  おすすめ順
                </button>
              </form>
            </div>

              <tr class="flex justify-between border-b border-grey-light">
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-xl text-grey-dark ">施設名</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-xl text-grey-dark ">おすすめ度</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($TagReviews as $review)
              
                <tr class="hover:bg-grey-lighter">
                  <td>
                    <p class="font-bold px-2 py-2 text-left text-grey-dark">{{$review->user->name}}</p>
                    <div class="md:w-1/2 transition duration-300  hover:scale-90 hover:rounded-lg flex justify-center">
                      <a href="{{ route('review.show', $review->id)}}">
                        <img class = "transition duration-300 hover:rounded-lg hover:opacity-80"src=" {{ asset('storage/'.$review->imgpath)}}">
                      </a>
                    </div>
                  </td>
                </tr>

                <tr class="hover:bg-grey-lighter">
                  
                  <td class="flex justify-between py-4 px-6 border-b border-grey-light">
                    <div class="flex space-x-5">  
                      <a href="{{ route('review.show', $review->id)}}">
                        <h3 class="text-left font-bold text-lg text-gray-700">{{$review->title}}</h3>
                      </a>
                      
                      @foreach($review->tags as $tag)
                      <a href="{{ route('tag.show', $tag->id)}}">
                        <div class="flex space-x-2">
                          <h3 class=" py-1 px-2  text-xs font-medium tracking-widest text-white  bg-red-300 shadow-lg rounded-full focus:outline-none duration-200 transition-all hover:bg-red-500 hover:shadow-none">{{$tag->name}}</h3>
                        </div>
                      </a>
                      @endforeach

                      <form action="{{ route('review.destroy',$review->id) }}" method="POST" class="text-left">
                        @method('delete')
                        @csrf
                        <button type="submit" class="mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-white py-1 px-2 focus:outline-none focus:shadow-outline">
                          <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="black">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                          </svg>
                        </button>
                      </form>
                      
                    </div>
                    <!-- <div class="flex"> -->
                      <!-- 更新ボタン -->
                      <!-- 削除ボタン -->
                    <!-- </div> -->
                    <h3 class="text-left text-yellow-400 text-lg text-grey-dark">
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
                    </h3>
                  </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
