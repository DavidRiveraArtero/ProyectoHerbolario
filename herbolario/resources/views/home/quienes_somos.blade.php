<html>

    @include('layoutsCompartido.head')
    <body>

        <div class="parallax" id="1">

                <div class="video" id="2">
                    <video src="{{asset('video/video1.mp4')}}" autoplay muted loop type="video/mp4"></video>
                </div>
                <div class="contenido" style="z-index: 2; background:rgba(255,255,255, 0.6);width: 500px">
                    <h3 style="color: black; font-size: 49px; font-family: 'Bahnschrift', Times, serif">Cuidarese es lo primero</h3>
                    <a href="{{route('home.index')}}"><svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor" class="bi bi-tree-fill" viewBox="0 0 16 16">
                        <path d="M8.416.223a.5.5 0 0 0-.832 0l-3 4.5A.5.5 0 0 0 5 5.5h.098L3.076 8.735A.5.5 0 0 0 3.5 9.5h.191l-1.638 3.276a.5.5 0 0 0 .447.724H7V16h2v-2.5h4.5a.5.5 0 0 0 .447-.724L12.31 9.5h.191a.5.5 0 0 0 .424-.765L10.902 5.5H11a.5.5 0 0 0 .416-.777l-3-4.5z"/>
                    </svg></a>
                </div>
        </div>


        <div class="parallax" style="background-color: gray">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</h3>
                    </div>
                    <div class="col-lg-5 col-12" id="p"></div>
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
                    <div class="col-lg-2 col-12" ></div>

                    <div class="col-lg-2 col-12" id="persona1">
                        <h1 style="margin-top: 300px">Usuario 1</h1>
                    </div>


                    <!-- CONTENEDOR FANTASMA -->
                    <div class="col-lg-4 col-12" ></div>


                    <div class="col-lg-2 col-12" id="persona2">
                        <h1 style="margin-top: 300px">Usuario 2</h1>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer_quienes_somos">
            <h1>Footer</h1>
        </footer>
    </body>


    <script>

    </script>
</html>
