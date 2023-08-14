$( document ).ready(function() {

    $('input:radio[name="metodoPagamento"]').change(function() {
      if ($(this).val() === 'cartao') {
          $('.dadosCartao').show();
      }else{
          $('.dadosCartao').hide();
      }
    });

    $( "#confirmar" ).on( "click", function() {
        var metodo = document.querySelector('input[name=metodoPagamento]:checked').value    
        const date =  new Date();
        date.setDate(date.getDate() + 7)
        const dueDate = date.toISOString().slice(0, 10);

        $.ajax({
            type: 'get',
            url: window.location.href+'api/user/find',
            data: {
              'cpfCnpj': $('#cpfCnpj').val(), 
            }
          }).done(function(response) {
            
            if(metodo == 'cartao'){
              var remoteIp;
              pegarIp()
              .then(resposta => {
                  remoteIp = resposta
                  
                  var datas =  {
                    'customer': response.data.customer,
                    'cpfCnpj': response.data.cpfCnpj,
                    'value': $('#value').val(),
                    'dueDate': dueDate,
                    'holderName': $('#holderName').val(),
                    'number' : $('#number').val(),
                    'expiryMonth' : $('#expiryMonth').val(),
                    'expiryYear': $('#expiryYear').val(),
                    'ccv': $('#ccv').val(),
                    'name': $('#firstName').val() +' '+$('#lastName').val(),
                    'email' : $('#email').val(),
                    'cpfCnpj' : $('#cpfCnpj').val(),
                    'phone' : $('#phone').val(),
                    'postalCode' : $('#postalCode').val(),
                    'addressNumber': $('#addressNumber').val(),
                    'remoteIp' : remoteIp,
                  }

                  criarCobranca(datas,metodo);

              })
              .catch(erro => {
                  erro();
              });

            }else if(metodo == 'pix'){
              var datas =  {
                'customer': response.data.customer,
                'cpfCnpj': response.data.cpfCnpj,
                'value': $('#value').val(),
                'dueDate': dueDate
              }

              criarCobranca(datas,metodo);

            }else if(metodo == 'boleto'){
                var datas = {
                    'customer': response.data.customer,
                    'cpfCnpj': response.data.cpfCnpj,
                    'value': $('#value').val(),
                    'dueDate': dueDate
                }
               
                criarCobranca(datas,metodo);
            }
              
            
        
          }).fail(function(data) {
            if(data.status =='404'){
                $.ajax({
                    type: 'post',
                    url: window.location.href+'api/user/create',
                    data: {
                      'name':$('#firstName').val()+" "+$('#lastName').val(),
                      'cpfCnpj': $('#cpfCnpj').val(),
                      
                    }
                  }).done(function(response) {
                
                    if(metodo == 'cartao'){
                      var remoteIp;
                      pegarIp()
                      .then(resposta => {
                          remoteIp = resposta

                          console.log(remoteIp);
                          var datas =  {
                            'customer': response.data.customer,
                            'cpfCnpj': response.data.cpfCnpj,
                            'value': $('#value').val(),
                            'dueDate': dueDate,
                            'holderName': $('#holderName').val(),
                            'number' : $('#number').val(),
                            'expiryMonth' : $('#expiryMonth').val(),
                            'expiryYear': $('#expiryYear').val(),
                            'ccv': $('#ccv').val(),
                            'name': $('#firstName').val() +' '+$('#lastName').val(),
                            'email' : $('#email').val(),
                            'cpfCnpj' : $('#cpfCnpj').val(),
                            'phone' : $('#phone').val(),
                            'postalCode' : $('#postalCode').val(),
                            'addressNumber': $('#addressNumber').val(),
                            'remoteIp' : remoteIp,
                          }

                          criarCobranca(datas,metodo);

                      })
                      .catch(erro => {
                          
                      });

                    }else if(metodo == 'pix'){
                      var datas =  {
                        'customer': response.data.customer,
                        'cpfCnpj': response.data.cpfCnpj,
                        'value': $('#value').val(),
                        'dueDate': dueDate
                      }

                      criarCobranca(datas,metodo);
                      
                    }else if(metodo == 'boleto'){
                       var datas =  {
                            'customer': response.data.customer,
                            'cpfCnpj': response.data.cpfCnpj,
                            'value': $('#value').val(),
                            'dueDate': dueDate
                        }
                       
                        criarCobranca(datas.data,metodo);

                    }
                      
                    
                
                  }).fail(function(data) {
                    erro();
                }); 

            }else{
              erro();
            }
            
        });   
    } );

    function criarCobranca(data,metodo){
      
        $.ajax({
            type: 'post',
            url: window.location.href+'api/'+metodo,
            data: data
          }).done(function(datas) {
              sessionStorage.setItem("metodo", metodo);
            if(metodo == 'boleto'){
                sessionStorage.setItem("link", datas.data.bankSlipUrl);
            }else if(metodo == 'pix'){

                sessionStorage.setItem("QRcode", datas.data.QRcode);
                sessionStorage.setItem("copiaCola", datas.data.copiaCola);
                sessionStorage.setItem("expiraEm", datas.data.expiraEm);
            }
            
            window.location.assign(window.location.href+'finalizacao');

          }).fail(function(data) {
            erro();
        }); 
    }
});
function pegarIp(resolver = true) {
  return new Promise((resolve, reject) => {
            $(function() {
              $.getJSON("https://api.ipify.org?format=jsonp&callback=?",
              function(json) {
                  if (!resolver) {
                      reject("Deu erro");
                  }
                resolve(json.ip);
              }
              );
            });
  });
}
function erro(){
  Swal.fire({
    title: 'Não foi possível realizar o pagamento!',
    text: 'Se o problema persistir, contate o suporte',
    icon: 'error',
    confirmButtonText: 'OK'
  })
}