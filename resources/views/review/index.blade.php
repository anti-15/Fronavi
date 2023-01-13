
<x-app-layout>

  <div class="py-12">
    <div class="max-w-xl mx-auto sm:w-10/12 md:w-8/10 ">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-4 bg-white border-b border-gray-200">
          <h1 class="text-center text-3xl">フロメグ！</h1>
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

              <tr class="flex justify-between border-b border-grey-light mt-4">
                @include('common.errors')
                <form class="mb-6" action="{{ route('search.result') }}" method="GET">
                  @csrf
                  <div class="flex mt-4 h-9">
                    <input class="w-5/6 border-gray-300" type="text" name="keyword" placeholder="キーワードを入力">
                    <button type="submit" class="flex justify-center items-center w-1/6 border border-indigo-400 text-white uppercase shadow-sm focus:outline-none  hover:shadow-2xl">
                      <svg class="h-5 w-5 text-indigo-400"  width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="10" cy="10" r="7" />  <line x1="21" y1="21" x2="15" y2="15" /></svg>
                    </button>
                  </div>
                </form>
              </tr>
              
            </thead>
            <tbody>
              @foreach ($reviews as $review)
              
                <tr class="hover:bg-grey-lighter">
                  <td>
                    <div class="flex justify-between">
                      <p class="font-bold px-2 py-2 text-left text-grey-dark">{{$review->user->name}}</p>

                    <div class ="flex">
                      @if($review -> user_id === Auth::user()->id)
                        <form action="{{ route('review.edit',$review->id) }}" method="GET" class="text-left">
                          @csrf
                          <button type="submit" class="text-sm hover:bg-gray-200 hover:shadow-none text-white py-1 px-2 focus:outline-none focus:shadow-outline">
                            <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="black">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                          </button>
                        </form>

                        <form action="{{ route('review.destroy',$review->id) }}" onClick= "return confirm('本当に削除しますか？')" method="POST" class="text-left">
                          @method('delete')
                          @csrf
                          <button type="submit" class=" text-sm hover:bg-gray-200 hover:shadow-none text-white py-1 px-2 focus:outline-none focus:shadow-outline">
                            <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="black">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                          </button>
                        </form>
                      @endif
                    </div>
                    </div>
                  
                    <div class=" transition duration-300  hover:scale-90 hover:rounded-lg flex justify-center">
                      <a href="{{ route('review.show', $review->id)}}">
                        <img class = "transition duration-300 hover:rounded-lg hover:opacity-80"src="{{$review->imgpath}}">
                      </a>
                    </div>
                  </td>
                </tr>

                <tr class="hover:bg-grey-lighter">
                  
                  <td class="flex justify-between pt-4 px-1 border-grey-light">

                    <div class="flex space-x-1 items-center">  
                      <a href="{{ route('review.show', $review->id)}}">
                        <h3 class="text-left font-bold text-lg text-grey-dark">{{$review->title}}</h3>
                      </a>

                      @if($review->users()->where('user_id', Auth::id())->exists())
                    <!-- unfavorite ボタン -->
                    <form action="{{ route('unfavorites',$review) }}" method="POST" class="text-left">
                      @csrf
                      <button type="submit" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-red py-1 px-2 focus:outline-none focus:shadow-outline">
                        <svg class="h-6 w-6 text-red-500" fill="red" viewBox="0 0 24 24" stroke="red">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        {{ $review->users()->count() }}
                      </button>
                    </form>
                    @else
                    <!-- favorite ボタン -->
                    <form action="{{ route('favorites',$review) }}" method="POST" class="text-left">
                      @csrf
                      <button type="submit" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-black py-1 px-2 focus:outline-none focus:shadow-outline">
                        <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="black">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        {{ $review->users()->count() }}
                      </button>
                    </form>
                    @endif
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

                <tr>
                  <td class="flex space-x-2 border-b">
                    @foreach($review->tags as $tag)
                      <a href="{{ route('tag.show', $tag->id)}}">
                        <div class="flex space-x-2  pb-2">
                          <h3 class=" py-1 px-2  text-xs font-medium tracking-widest text-white  bg-red-300 shadow-lg rounded-full focus:outline-none duration-200 transition-all hover:bg-red-500 hover:shadow-none">{{$tag->name}}</h3>
                        </div>
                      </a>
                      @endforeach
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

