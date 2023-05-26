@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="container  mx-auto  py-12">
    <h1>DETALLE DE ANUNCIO</h1>
    <div class=" text-center m-12">
        <h5 class="text-4xl md:text-3xl font-semibold text-indigo-700 mb-1">Detalle Anuncios</h5>
        <h1 class="text-2xl md:text-3xl text-gray-700 font-semibold">Conjunto de anuncios no mayor a 90 dias </h1>
    </div>
    <div class="form-group mb-5 ">
        <label for="" class="text-center flex "> Filtro por fecha</label>
    <form action="" method="GET" class="flex gap-4  justify-center " >
        @csrf
        <div>
            <label for="desde">Desde</label>
            <input type="date" pattern="Y-m-d"  id="desde" required name="desde" class="form-control mt-2"  placeholder="fecha de inicio"
                value="{{ request()->get('desde')}}">
        </div>
        <div>
            <label for="hasta">Hasta</label>
            <input type="date" pattern="Y-m-d"  id="hasta" required name="hasta" class="form-control mt-2" placeholder="fecha final"
                value="{{ request()->get('hasta')}}">
        </div>
        <button type="submit" class="bg-[#646FD4] rounded-full text-white text-2xl p-2 item-center w-[20%] hover:bg-indigo-200 " >


           Filtrar

        </button>
    </form>



    </div>

    <div class="columns-[2] gap-4">

        <div class="bg-indigo-400     h-60  ">
            <h2 class=" text-indigo-100  font-semibold text-lg  mb-1 p-2 mt-2">Anuncio</h2>
            {{-- <p>{{ $name }}</p> --}}
            @foreach ($name as $item)
                {{ $item }}
            @endforeach
            <h2 class=" text-indigo-100  font-semibold text-lg  mb-1 p-2 mt-2">Importe Gastado</h2>
            {{-- <p>{{ $gasto }}</p> --}}
            @foreach ($gasto as $item)
                {{ $item }}
            @endforeach
        </div>
        <div class="bg-indigo-400    h-60  ">
            <h2 class=" text-indigo-100  font-semibold text-lg  mb-1 p-2 mt-2"> Intereses</h2>
            <p class="    text-base   mb-3  ">

                    @foreach ( $interests as $inte)
                        {{ $inte }}
                    @endforeach

            </p>

            <h2 class=" text-indigo-100  font-semibold text-lg  mb-1 p-2 mt-2">Lugares</h2>
            @foreach ($locations as $item)
         <h2>{{ $item }}</h2>
           @endforeach
        </div>
    </div>

    <div class="flex justify-end mt-40">
        <button  class="bg-[#646FD4] rounded-full text-white text-2xl p-2 item-center w-[20%] hover:bg-indigo-200 " >
            Reporte
         </button>
    </div>

</div>
