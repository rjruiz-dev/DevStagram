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
});

// ver como se sube el archivo, si hay un error, personalizar la peticion enviada

// file: el archivo actual, xhr: la peticion, formData: la forma de subir enviar informacion
dropzone.on('sending', function(file, xhr, formData) {
    console.log(file);
});

dropzone.on('success', function(file, response) {
    console.log(response);
});

dropzone.on('error', function(file, message) {
    console.log(message);
});

dropzone.on('removedfile', function() {
    console.log("Archivo Eliminado");
});