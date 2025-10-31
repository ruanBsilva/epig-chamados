function inicializarEquipamentos() {

};

function geraCodBarra() {
    var TOKEN = '22702|MGTYrO4axANaRBukOIxahqbWZAXCGwuS';
    var textoParaCodigo = document.getElementById('txt-dado-codigo').value;

    $.ajax({
        type: 'get',
        url: `https://api.invertexto.com/v1/barcode`,
        dataType: 'json',
        data: {
            token: TOKEN,
            text: textoParaCodigo,
            type: 'code128',
            base64: true

        },
        success: function (resposta) {
            console.log("Resposta da API:", resposta);

            document.getElementById('img-codigo-ajax').src = resposta.image;
        }
    })
}

