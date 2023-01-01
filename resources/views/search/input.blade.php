<x-app-layout>
<div class="bg-white py-6 sm:py-8 lg:py-12">
  <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">
    <!-- テキスト -->
    <div class="mb-6 md:mb-8">
      <h2 class="text-gray-800 text-2xl lg:text-3xl font-bold text-center mb-4 md:mb-6">温泉を検索！</h2>

      <p class="max-w-screen-md text-gray-500 md:text-lg text-center mx-auto">施設名、エリア、タグ、説明、ユーザー名で検索できます！</p>
    </div>

    <form class="max-w-screen-md grid sm:grid-cols-3 gap-4 mx-auto" action="{{ route('search.result') }}" method="GET" >
      @include('common.errors')
      @csrf

      <div class="sm:col-span-3">
        <label for="title" class="font-bold inline-block text-gray-800 text-sm sm:text-base mb-2">施設名</label>
        <input type = "text" name="keyword" class="w-full bg-gray-50 text-gray-800 border-1 focus:outline-none ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2">
      </div>



      <div class="sm:col-span-3 flex justify-center items-center">
        <button class="inline-block w-1/2 bg-red-400 hover:bg-red-600 active:bg-indigo-700 focus-visible:ring ring-indigo-300 text-white text-sm md:text-base font-semibold text-center rounded-lg outline-none transition duration-100 px-8 py-3">投稿！</button> 
      </div>
    </form>
  </div>
</div>
</x-app-layout>