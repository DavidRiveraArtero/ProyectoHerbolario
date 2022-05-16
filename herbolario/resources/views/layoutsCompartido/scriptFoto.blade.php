<script>
    console.log("hola");
    var cont = 0;
    //var divInput = document.getElementById('drop-area')

    // ************************ Drag and drop ***************** //
    let dropArea = document.getElementById("drop-area")

        // Prevent default drag behaviors


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

