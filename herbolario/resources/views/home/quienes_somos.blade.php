<html>

    @include('layoutsCompartido.head')
    <body>

        <div class="parallax" id="1">

                <div class="video" id="2">
                    <video style="width: 100%" src="{{asset('video/VideoFinal.mov')}}" autoplay muted loop type="video/mp4"></video>
                </div>
                <div class="contenido" style="z-index: 2; background:rgba(255,255,255, 0.9);width: 100%">
                    <h3 style="color: black; font-size: 49px; font-family: 'Bahnschrift', Times, serif">Cuidarese es lo primero</h3>
                    <a href="{{route('home.index')}}"><svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor" class="bi bi-tree-fill" viewBox="0 0 16 16">
                        <path d="M8.416.223a.5.5 0 0 0-.832 0l-3 4.5A.5.5 0 0 0 5 5.5h.098L3.076 8.735A.5.5 0 0 0 3.5 9.5h.191l-1.638 3.276a.5.5 0 0 0 .447.724H7V16h2v-2.5h4.5a.5.5 0 0 0 .447-.724L12.31 9.5h.191a.5.5 0 0 0 .424-.765L10.902 5.5H11a.5.5 0 0 0 .416-.777l-3-4.5z"/>
                    </svg></a>
                </div>
        </div>


        <div class="parallax" style="background-color: gray">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12" style="margin-bottom: 50px; color: white" ><h1>Nuestra empresa<hr style="height: 1px; color: white;width: 100%"></h1>  </div>

                    <div class="col-lg-6 col-12">
                        <h3 style="color: white"> in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</h3>
                    </div>
                    <div class="col-lg-6 col-12" id="p"></div>
                </div>
            </div>
        </div>


        <div class="body_quienes_somos">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <h1 style="text-align: center; height: 49px">Quienes somos</h1>
                    </div>
                </div>
                <div class="row" style="margin-top: 150px">
                    <!-- CONTENEDOR FANTASMA -->
                    <div class="col-lg-2 col-1"></div>

                    <div class="col-lg-2 col-5" id="persona1" style="float: left">
                        <img src="{{asset("img/1.jpg")}}" style="width: 100%; height: 100%; border-radius: 50%">
                        <h1 style="">Usuario 1</h1>
                    </div>


                    <!-- CONTENEDOR FANTASMA -->
                    <div class="col-lg-4 col-1" style="float: left"></div>


                    <div class="col-lg-2 col-5" id="persona2" style="float: left">
                        <img src="{{asset("img/1.jpg")}}" style="width: 100%; height: 100%; border-radius: 50%">
                        <h1 style="">Usuario 2</h1>
                    </div>
                </div>
            </div>
        </div>


    </body>


    <script>

    </script>
</html>
