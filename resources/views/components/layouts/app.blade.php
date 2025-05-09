<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>



    <div class="pt-0 pb-4 px-6 text-center">
        <div class="w-70 max-w-full flex justify-center m-auto text-shadow-lg " >
            <img src="{{ asset('assets/images/chips.png') }}" class="w-full  drop-shadow-xl drop-shadow-black" >
        </div>            
        <p class="text-cyan-600 my-5 text-3xl text-shadow-sm text-shadow-cyan-300 font-bold">الذكرى السنوية الثامنة</p>
    </div>



        {{ $slot }}





        <div class="bg-cyan-600 text-white rounded-xl mx-4 my-6 p-4 shadow-lg mb-2">
            <h2 class="text-center font-semibold text-xl mb-5">الجوائز المتوفرة</h2>
            <div class="flex justify-around items-center text-center">
                <div class="flex flex-col items-center">
                    <img src="{{ asset('assets/images/playstition5.png') }} " class="w-25">    
                    <p class="mt-5 text-2md font-medium">بلايستيشن 5</p>
                </div>
                <div class="flex flex-col items-center">
                    <img src="{{ asset('assets/images/iphone.png') }}" class="w-25">    
                    <p class="mt-5 text-2md font-medium">آيفون 16</p>
                </div>
            </div>
        </div>

        
        <footer class="mx-[-24px] mb-[-24px] mt-6">
            <div class="bg-cyan-600 text-white py-5 px-4">
                <div class="container mx-auto flex flex-col items-center text-center space-y-6">
    
                    <div class="w-50  mb-2 ">
                        <img src="{{ asset('assets/images/prisma.png') }}" class="w-full">
                    </div>
    
                    
    
                    
    
                    <div class="flex justify-center space-x-4 pt-4">
                        <a target="_BLNAK" href="https://www.facebook.com/rawkettlecookedpotatoes/?_rdc=2&_rdr" aria-label="Facebook" class="bg-white/20 hover:bg-white/30 rounded-full p-3 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v2.385z"/>
                            </svg>
                        </a>
                        <a target="_BLNAK" href="https://www.instagram.com/rawkettlecooked/?hl=en" aria-label="Instagram" class="bg-white/20 hover:bg-white/30 rounded-full p-3 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a target="_BLNAK" href="https://www.linkedin.com/company/prismafoodsegypt/posts/?feedView=all&viewAsMember=true" aria-label="LinkedIn" class="bg-white/20 hover:bg-white/30 rounded-full p-3 transition duration-300">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                 <path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.59-11.018-3.714v-2.155z"/>
                             </svg>
                        </a>
                        <a target="_BLNAK" href="tel:5700" aria-label="LinkedIn" class="bg-white/20 hover:bg-white/30 rounded-full p-3 transition duration-300">
                            <svg class="h-4 w-4 text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M280 0C408.1 0 512 103.9 512 232c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-101.6-82.4-184-184-184c-13.3 0-24-10.7-24-24s10.7-24 24-24zm8 192a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm-32-72c0-13.3 10.7-24 24-24c75.1 0 136 60.9 136 136c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-48.6-39.4-88-88-88c-13.3 0-24-10.7-24-24zM117.5 1.4c19.4-5.3 39.7 4.6 47.4 23.2l40 96c6.8 16.3 2.1 35.2-11.6 46.3L144 207.3c33.3 70.4 90.3 127.4 160.7 160.7L345 318.7c11.2-13.7 30-18.4 46.3-11.6l96 40c18.6 7.7 28.5 28 23.2 47.4l-24 88C481.8 499.9 466 512 448 512C200.6 512 0 311.4 0 64C0 46 12.1 30.2 29.5 25.4l88-24z"/></svg>
                       </a>
                    </div>
                </div>
            </div>
    
            <div class="bg-cyan-800 text-white py-3 px-4">
                <div class="container mx-auto text-center text-xs md:text-sm">
                    <p>
                        <span style="color: #ffffff;">Designed and developed by 
                            <a style="color: #ffffff;" title="Digital Marketing agency - E-marketing - web design - filming and directing - designing logos " href="https://firstmarkets.com/" target="_blank" rel="noopener">FirstMarkets</a>
                        </span>
                    </p>
                </div>
            </div>
        </footer>








    </flux:main>


    


</x-layouts.app.sidebar>
