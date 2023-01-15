<x-app-layout>
<div class="bg-white py-6 sm:py-8 lg:py-12">
  <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">
    <!-- テキスト -->
    <div class="mb-6 md:mb-8">
      <h2 class="text-gray-800 text-2xl lg:text-3xl font-bold text-center mb-4 md:mb-6">温泉を投稿！</h2>

      <p class="max-w-screen-md text-gray-500 md:text-lg text-center mx-auto">最近行った温泉でお気に入りの温泉があれば是非投稿してください！<br>説明欄にはイチオシポイントや、持っていった方がいいものや注意点などを記述しましょう！</p>
    </div>

    <form class="max-w-screen-md grid sm:grid-cols-3 gap-4 mx-auto" action="{{ route('review.store') }}" method="POST" enctype="multipart/form-data">
      @include('common.errors')
      @csrf

      <div class="sm:col-span-3">
        <label for="title" class="font-bold inline-block text-gray-800 text-sm sm:text-base mb-2">施設名</label>
        <input type = "text" name="title" class="w-full bg-gray-50 text-gray-800 border-1 focus:outline-none ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2">
      </div>

      <div>
        <label for="lscore" class="inline-block text-gray-800 text-sm sm:text-base mb-2">おすすめ度</label>
        <select class="w-full border rounded-md py-2 px-3 text-gray-800 outline-none" type="text" name="score" id="">
          <option class="" value="">選択して下さい</option>
          <option value="1">★</option>
          <option value="2">★★</option>
          <option value="3">★★★</option>
          <option value="4">★★★★</option>
          <option value="5">★★★★★</option>
        </select>
      </div>

      <div class="">
        <label for="tag" class="inline-block text-gray-800 text-sm sm:text-base mb-2">エリア</label>
        <select class="w-full  rounded-md py-2 px-3 text-gray-800 outline-none" type="text" name="tag" id="">
          <option class="text-gray-400" value=" ">選択して下さい</option>
          <option value="北海道">北海道</option>
          <option value="東北">東北</option>
          <option value="関東">関東</option>
          <option value="関西">関西</option>
          <option value="中国・四国">中国・四国</option>
          <option value="九州・沖縄">九州・沖縄</option>
        </select>
      </div>

      <div class="flex flex-col">
        <label for="" class=" inline-block text-gray-800 text-sm sm:text-base mb-2">フリータグ</label>
        <input type = "text" name="freetag" class="w-full  text-gray-800 border-1 focus:outline-none ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2" placeholder="例:サウナ、露天風呂">
        <span class="text-sm text-[13px] text-red-600">、で区切るようにしてください</span>
      </div>

      <div class="sm:col-span-3">
        <label for="description" class="inline-block text-gray-800 text-sm sm:text-base mb-2">説明</label>
        <textarea name="description" class="w-full h-32 bg-gray-50 text-gray-800 border outline-none rounded transition duration-100 px-3 py-2"></textarea>
      </div>
      
      <div class="sm:col-span-3 flex justify-between items-center">
        <div class="">
          @csrf
          <input type="file" name="imgpath" value ="">
          <p class="max-w-screen-md text-gray-500  text-left ">横画像推奨</p>
        </div>
      </div>

      <div class="sm:col-span-3 flex justify-center items-center">
        <button class="inline-block w-1/2 bg-red-400 hover:bg-red-600 active:bg-indigo-700 focus-visible:ring ring-indigo-300 text-white text-sm md:text-base font-semibold text-center rounded-lg outline-none transition duration-100 px-8 py-3">投稿！</button> 
      </div>
    </form>
  </div>
</div>
</x-app-layout>