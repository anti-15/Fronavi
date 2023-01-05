<x-app-layout>
    <div class="bg-white py-6 sm:py-8 lg:py-12 ">
        <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">
            <div class="md:h-96 flex flex-col sm:flex-row rounded-lg overflow-hidden">
            <!-- content - start -->
            <div class="w-full sm:w-1/2 lg:w-2/5 flex flex-col p-4 sm:p-8">
                <h1 class="text-black text-xl md:text-2xl lg:text-4xl font-bold mb-4">フロナビ！</h1>
                <h2 class="text-black text-lg md:text-xl lg:text-3xl font-bold mb-4">お気に入りの温泉をシェアしませんか？</h2>

                <p class="max-w-md text-gray-400 mb-8">温泉好きが集まり、お気に入りの温泉を共有するサイトです。インスタグラムと同じような機能をそなえていて投稿、いいね、タグ検索、などができます！</p>
                
                <div class="space-x-2 mt-3">
                    <a href="{{ route('login') }}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">ログイン</a>
                    <a href="{{ route('register') }}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">新規登録</a>
                </div>
                
                
            </div>
            <!-- content - end -->

            <!-- image - start -->
            <div class="w-full sm:w-1/2 lg:w-3/5 h-60 sm:h-auto  order-first sm:order-none ">
                <img src="/storage/6075643547dc094fbc9408ad_59.png" loading="lazy" alt="お風呂に入る女の子" class="w-full h-full object-cover object-center" />
            </div>
            <!-- image - end -->
            </div>
        </div>
    </div>
</x-app-layout>
