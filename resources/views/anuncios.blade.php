
@vite(['resources/css/app.css', 'resources/js/app.js'])


<main class=" bg-indigo-100 ">
    <section class=" flex  items-center text-gray-600">
        <div class="container px-5 py-24 mx-auto" >
            <div class=" text-center m-12">
                <h5 class="text-4xl md:text-3xl font-semibold text-indigo-700 mb-1">Anuncios</h5>
                <h1 class="text-2xl md:text-3xl text-gray-700 font-semibold">Conjunto de anuncios no mayor a 90 dias </h1>
            </div>
            <div class="flex flex-wrap -m-4 ">


                @foreach ($timeAdsets as $anuncios )
                <div class="p-4 sm:w-1/2 lg:w-1/3 bg-white border-2 border-indigo-500/100  ">
                    <div class="  border-2 border-gray-200  border-opacity-60 rounded-lg  overflow-hidden ">
                        <img src={{ $anuncios['image'] }} alt="" class="lg:h-72 md:h-48 w-full  object-cover object-center">
                    </div>
                    <div class="p-6 hover:bg-indigo-500 hover:text-white transition duration-300 ease-in">
                        <h2 class="text-base font-medium text-indigo-300 mb-1 inline-block">{{$anuncios['end_time'] }}</h2>
                        <h1 class="text-base  font-semibold mb-3"> {{ $anuncios['name'] }}</h1>
                        <span>{{ $anuncios['id'] }}</span>
                    </div>
                    <div class="flex justify-end">
                        <button
                        class="bg-[#646FD4] rounded-lg text-white  p-5 item-center  hover:bg-indigo-200 "><a
                            href= "{{ route('detalle-anuncio', ['ad_id'=> $anuncios['id']] )}}">
                            {{-- {{ route('detalle-anuncio', ['ad_id'=> $anuncios['id']] )}} --}}
                            Detalle
                        </a>
                    </button>
                    </div>
                </div>

                @endforeach


            </div>

        </div>

    </section>


</main>
