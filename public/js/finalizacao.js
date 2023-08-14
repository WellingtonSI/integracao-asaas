$( document ).ready(function() {
    var metodo = sessionStorage.getItem("metodo");


   
    

    if(metodo == 'pix'){

        const imgElement = $('<img>').attr('id', 'imgElem');

        const buttonElement = $('<button>').text(sessionStorage.getItem("copiaCola"));

        $('.conteudo').append(imgElement, buttonElement);

        imgElem.setAttribute('src','data:image/png;base64,'+sessionStorage.getItem("QRcode"));
    }else if(metodo == 'boleto'){
        const title = $('<h4>').text('Click no botão para gerar o boleto');
        const link = $('<a>').attr('id', 'link').attr('href',sessionStorage.getItem("link")).attr('target',"_blank").text('Gerar Boleto');
        $('.conteudo').append(title,link);
    }else if(metodo == 'cartao'){
        const title = $('<h4>').text('Compra realizada com sucesso!');
        $('.conteudo').append(title);
    }





});

