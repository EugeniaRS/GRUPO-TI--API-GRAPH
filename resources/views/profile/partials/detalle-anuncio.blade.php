<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="p-4 sm:w-1/2 lg-w-1/3 bg-gray-300  mx-auto mt-9 ">
        <div class="h-full  border-5 border-red-700     border-opacity-60 rounded-lg overflow-hidden">
         <img src="" alt="">
         <div class="p-6 hover:bg-indigo-500 hover:text-white transition  duration-300 ease-in  ">
          <h2 class="text-2xl font-medium text-indigo-700 mb-1s"> Nombre</h2>
         </div>
        </div>

    </div>
</x-app-layout>
