export const UseUploadPhoto = (element, form) => {
    const onFileChange = (e) => {
        var files = e.target.files || e.dataTransfer.files;
        let arquivo = files[0].name;
        let extension = arquivo.indexOf(".") < 1 ? "" : arquivo.split(".").pop();
        if (extension) {
            let formatos_permitidos = [
                "jpg",
                "png",
                "gif",
                "jpeg",
                "JPG",
                "PNG",
                "GIF",
                "JPEG",
            ];

            let resultado = formatos_permitidos.includes(extension);
            if (resultado) {
                // tamanho do arquivo suportado em MB
                var tamanho_maximo = 2242880;
                var fsizet = 0;
                for (var i = 0; i <= e.target.files.length - 1; i++) {
                    var fsize = e.target.files.item(i).size;
                    fsizet = fsizet + fsize;
                }

                if (fsizet > tamanho_maximo) {
                    console.log(
                        "Tamanho do arquivo é maior que 5mb 'Tamanho máximo  = 2MB' "
                    );
                } else {
                    createImg(files[0]);
                }
            }
        }
    };

    const createImg = (file) => {
        var imagem = new Image();
        var reader = new FileReader();

        reader.onload = (e) => {
            element.imagem = e.target.result;
            form.imagem = element.imagem;
        };

        reader.readAsDataURL(file);
    };

    return {
        onFileChange,
        createImg,
    };
};