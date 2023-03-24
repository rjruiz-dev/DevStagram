import Dropzone from "dropzone";

// autoDiscover = false; por default Dropzone busca un elemento que tenga la clase de dropzone, 
// pero quiero darle el comportamiento y decirle a que endpoint y a que ruta queremos enviar las peticiones
Dropzone.autoDiscover = false

// configuracion de dropzone
const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube aquí tu imagen",
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar Archivo",
    maxFiles: 1,
    uploadMultiple: false
})