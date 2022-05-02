@include('layoutsCompartido.head')
<body>
    <header style="margin-bottom: 40px" >
        <div class="txt-centrado marg-top15px">
            <a href="{{route('home.index')}}"><span style="font-weight: bold;">Inicio</span></a><span style="font-weight: bold;"> / Añadir productos</span>
            <h3 style="font-weight: bold;">Añadir Producto</h3>
        </div>
    </header>
    @include('layoutsCompartido.adminNavegacion')

    <div id="contenedor_create" class="container">

        <form method="POST" action="{{route('productos.store')}}" class="row" enctype="multipart/form-data">

            @csrf
            {{csrf_field()}}
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
                <input type="file" id="fileElem" multiple accept="image/*" onchange="handleFiles(this.files)" name="file_path[]">
                <div id="gallery" /></div>
                <progress id="progress-bar" max=100 value=0></progress>
            </div>
            <button class="btn btn-primary col-lg-12" type="submit" id="send" style="float: right; margin-top:40px">Crear Producto</button>
        </form>
    </div>
</body>

<script>
    var cont = 0;
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
        files = [...files]

        files.forEach(uploadFile)
    }

    function handleFiles(files) {
        console.log("handleFiles")
        files = [...files]
        files.forEach(uploadFile)
        files.forEach(previewFile)
    }

    function previewFile(file) {
        // Preview
        let reader = new FileReader()

        reader.readAsDataURL(file)
        reader.onloadend = function() {
            let img = document.createElement('img')
            img.src = reader.result
            console.log('files', file)
            document.getElementById('gallery').appendChild(img)
        }
    }

    function uploadFile(file) {
        // Upload
        var inputFile = document.createElement('input')
        inputFile.setAttribute('type','file')
        inputFile.setAttribute('name','file_path[]')
        inputFile.setAttribute('multiple','multiple')
        inputFile.addEventListener("change", (event) => {
            handleFiles(event.target.files)
        })
        dropArea.appendChild(inputFile)
    }
</script>
