<x-app-layout>
    {{-- <x-slot name="header"> --}}
       {{--  <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
    {{-- </x-slot> --}}
{{--
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> --}}
    <div class="p-4 sm:w-1/2 lg-w-1/3 bg-gray-300  mx-auto rounded-md mt-12   ">
        <div class="h-full  border-5 border-red-700     border-opacity-60 rounded-lg overflow-hidden">
         <div class="p-6 text-center hover:text-white transition  duration-300 ease-in  ">
          <h2 class="text-2xl font-medium text-indigo-700 mb-1s"> Es necesario contar con una  red social</h2>
          <button
          class=" bg-blue-800  rounded-full text-white text-2xl p-5 item-center w-[70%] hover:bg-blue-200  "><a
             href="{{ route('anuncio') }}" >
             {{--   href="https://www.facebook.com/" --}}
              facebook
          </a>
      </button>
      <button
      class=" bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500  mt-5   rounded-full text-white text-2xl p-5 item-center w-[70%] hover:from-pink-500 hover:to-yellow-500 "><a
      href="{{ route('anuncio') }}" >
          {{-- href="https://www.instagram.com/"  --}}
          Instagram
      </a>
  </button>
         </div>
        </div>

    </div>
</x-app-layout>
