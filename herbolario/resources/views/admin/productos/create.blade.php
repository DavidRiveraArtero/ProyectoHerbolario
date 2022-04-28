@include('layoutsCompartido.head')
<body>
    <header style="margin-bottom: 40px" >
        <div class="txt-centrado marg-top15px">
            <a href="{{route('home.index')}}"><span style="font-weight: bold;">Inicio</span></a><span style="font-weight: bold;"> / Añadir productos</span>
            <h3 style="font-weight: bold;">Añadir Producto</h3>
        </div>
    </header>
    <div class="icono_lista dropdown">
        <svg xmlns="http://www.w3.org/2000/svg" width="75" height="75" fill="currentColor" class="bi bi-filter-left btm dropdown-toggle" style="float: left" id="dropdownList" data-bs-toggle="dropdown" aria-expanded="false" viewBox="0 0 16 16">
            <path d="M2 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
        </svg>
        <div class="dropdown-menu float-start contenedor_dropdown" aria-labelledby="dropdownList" >
            <a class="btn btn-primary marg-bot15px" href="{{route('productos.index')}}">Listar Productos</a>
            <a class="btn btn-primary marg-bot15px" href="{{route('productos.create')}}">Crear Productos</a>
            <a class="btn btn-primary marg-bot15px">Listar Usuarios</a>
            <a class="btn btn-primary">Crear Usuarios</a>
        </div>
    </div>

    <div id="contenedor_create" class="container">

        <form method="POST" action="{{route('productos.store')}}" class="row" >

            @csrf
            @method('post')

            <did class="contenedor_create_inputs col-xl-1">
                <h3>Nombre Producto</h3>
                <input class="contenedor_inputs_line" type="text" placeholder="Nombre Producto" name="nombre">
            </did>

            <div class="contenedor_create_inputs ">
                <h3 >Precio Producto</h3>
                <input class="contenedor_inputs_line" type="text" placeholder="Precio" name="precio">
            </div>

            <div class="contenedor_create_inputs">
                <h3>Descripcion</h3>
                <input class="contenedor_inputs_line" type="text" placeholder="Descripcion" name="descripcion">
            </div>
            <did class="contenedor_create_inputs">
                <h3>Cantidad</h3>
                <input class="contenedor_inputs_line" type="text" placeholder="Cantidad" name="cantidad">
            </did>
            <div id="drop-area" class="input-file">

                <p>Upload multiple files with the file dialog or by dragging and dropping images onto the dashed region</p>

                <label class="button" for="fileElem" onclick="handleFiles(this.files)">Select some files</label>

                <progress id="progress-bar" max=100 value=0></progress>

            </div>
            <button class="btn btn-primary col-lg-12" type="submit" id="send" style="float: right; margin-top:40px">Crear Producto</button>
        </form>

    </div>
</body>

<script>
    var cont = 0;
    var listaImg = [];
    //var divInput = document.getElementById('drop-area')

    // ************************ Drag and drop ***************** //
    let dropArea = document.getElementById("drop-area")

    // Prevent default drag behaviors
    ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false)
        document.body.addEventListener(eventName, preventDefaults, false)
    })

    // Highlight drop area when item is dragged over it
    ;['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false)
    })

    ;['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false)
    })

    // Handle dropped files
    dropArea.addEventListener('drop', handleDrop, false)

    function preventDefaults (e) {
        e.preventDefault()
        e.stopPropagation()
    }

    function highlight(e) {
        dropArea.classList.add('highlight')
    }

    function unhighlight(e) {
        dropArea.classList.remove('active')
    }

    function handleDrop(e) {
        var dt = e.dataTransfer
        var files = dt.files

        handleFiles(files)

    }

    let uploadProgress = []
    let progressBar = document.getElementById('progress-bar')

    function initializeProgress(numFiles) {
        progressBar.value = 0
        uploadProgress = []

        for(let i = numFiles; i > 0; i--) {
            uploadProgress.push(0)

        }

    }

    function updateProgress(fileNumber, percent) {
        uploadProgress[fileNumber] = percent
        let total = uploadProgress.reduce((tot, curr) => tot + curr, 0) / uploadProgress.length
        progressBar.value = total
    }

    function handleFiles(files) {
        files = [...files]
        initializeProgress(files.length)
        files.forEach(uploadFile)
        files.forEach(previewFile)

    }

    function previewFile(file) {
        let reader = new FileReader()
        reader.readAsDataURL(file)
        reader.onloadend = function() {
            let img = document.createElement('img')
            img.src = reader.result
            document.getElementById('gallery').appendChild(img)
        }
    }

    function uploadFile(file, i) {

        listaImg.push(file.name)

        for(var x = 0;x<listaImg.length; x++){
            console.log(listaImg[x]);

        }
        cont ++
        var inputFile = document.createElement('input')
        dropArea.appendChild(inputFile).setAttribute('id',cont)
        var algo = document.getElementById(cont)
        algo.setAttribute('type','text')
        algo.setAttribute('name','file_path[]')
        algo.setAttribute('value', file.name)
        algo.setAttribute('hidden','true')



    }
</script>
