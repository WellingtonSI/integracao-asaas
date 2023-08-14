<!DOCTYPE html>

<html lang="en" data-bs-theme="dark">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }
      .bd-mode-toggle {
        z-index: 1500;
      }
    </style>

</head>
<body class="bg-body-tertiary">
  <div class="container">
    <main>
      <div class="text-center p-4">
        <h2>Pagamento</h2>
      </div>

      <div class="row g-5">
        <div class="col-md-5 col-lg-4 order-md-last">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary">Itens</span>
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <div>
                <h6 class="my-0">Mesa de centro</h6>
              </div>
              <span class="text-body-secondary">R$ 100</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total</span>
              <strong>R$ 100</strong>
              <input type="text"  id="value" placeholder="" value="100" hidden>
            </li>
          </ul>
        </div>
        <div class="col-md-7 col-lg-8">
          <h5 class="text-body-secondary ">Preencha todos os campos visíveis</h5>
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="firstName" class="form-label">Nome</label>
                <input type="text" class="form-control" id="firstName" placeholder="" value="Teste" required="">
                <div class="invalid-feedback">
                  Nome é obrigatório.
                </div>
              </div>

              <div class="col-sm-6">
                <label for="lastName" class="form-label">Sobrenome</label>
                <input type="text" class="form-control" id="lastName" placeholder="" value="Sobrenome" required="">
                <div class="invalid-feedback">
                  Sobrenome é obrigatório.
                </div>
              </div>

              <div class="col-8">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" value="teste@gmail.com" placeholder="you@example.com">
                <div class="invalid-feedback">
                  Insira um endereço de e-mail válido para atualizações de envio.
                </div>
              </div>

              <div class="col-md-4">
                <label for="cpfCnpj" class="form-label">CPF / CNPJ</label>
                <input type="text" class="form-control" id="cpfCnpj" value="224.444.830-49" placeholder="" required="">
                <div class="invalid-feedback">
                  CPF / CNPJ é obrigatório.
                </div>
              </div>

              <div class="col-12">
                <label for="address" class="form-label">Endereço</label>
                <input type="text" class="form-control" id="address" value="Rua das Ruas" placeholder="Rua das Ruas" required="">
                <div class="invalid-feedback">
                  Favor inserir seu endereço de entrega.
                </div>
              </div>

              <div class="col-md-3">
                <label for="postalCode" class="form-label">CEP</label>
                <input type="text" class="form-control" id="postalCode" value="45000-000" placeholder="" required="">
                <div class="invalid-feedback">
                  CEP é obrigatório.
                </div>
              </div>

              <div class="col-md-3">
                <label for="addressNumber" class="form-label">Número do endereço</label>
                <input type="text" class="form-control" id="addressNumber" value="11" placeholder="" required="">
                <div class="invalid-feedback">
                  Número do endereço é obrigatório.
                </div>
              </div>

              <div class="col-md-3">
                <label for="phone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="phone" value="73900000000" placeholder="73900000000" required="">
                <div class="invalid-feedback">
                  Telefone é obrigatório.
                </div>
              </div>
            </div>

            <hr class="my-4">

            <h4 class="mb-3">Método de Pagamento</h4>

            <div class="my-3">
              <div class="form-check">
                <input id="cartao" name="metodoPagamento" type="radio" value="cartao" class="form-check-input" checked required="">
                <label class="form-check-label" for="cartao">Cartão de crédito</label>
              </div>
              <div class="form-check">
                <input id="pix" name="metodoPagamento" type="radio" value="pix" class="form-check-input" required="">
                <label class="form-check-label" for="pix">Pix</label>
              </div>
              <div class="form-check">
                <input id="boleto" name="metodoPagamento" type="radio" value="boleto" class="form-check-input" required="">
                <label class="form-check-label" for="boleto">Boleto</label>
              </div>
            </div>

            <div class="row gy-3 dadosCartao">
              <div class="col-md-6">
                <label for="holderName" class="form-label">Nome no cartão</label>
                <input type="text" class="form-control" value="Nome no Cartão" id="holderName" placeholder="" required="">
                <small class="text-body-secondary">Nome completo conforme exibido no cartão</small>
                <div class="invalid-feedback">
                  Nome no cartão é obrigatório
                </div>
              </div>

              <div class="col-md-6">
                <label for="number" class="form-label">Número do cartão de crédito</label>
                <input type="text" class="form-control" value="5512376515751257" id="number" placeholder="" required="">
                <div class="invalid-feedback">
                Número do cartão de crédito é obrigatório
                </div>
              </div>

              <div class="col-md-6">
                <div class="row gy-3">
                  <label for="expiration" class="form-label">Validade do cartão</label>
                  <div class="col-md-3 gy-2">
                    <input  type="text" class="form-control" value="12" id="expiryMonth" placeholder="Mês" required="">
                  </div>
                  <div class="col-md-3 gy-2">
                    <input type="text" class="form-control" value="2024" id="expiryYear" placeholder="Ano" required="">
                  </div>
                  <div class="invalid-feedback">
                    Mês e Ano do cartão são obrigatórios
                  </div>
                </div>
              </div>
              <div class="col-md-3 gy-4">
                <label for="ccv" class="form-label ">CCV</label>
                <input type="text" class="form-control" value="252" id="ccv" placeholder="" required="">
                <div class="invalid-feedback">
                  CVV é obrigatório
                </div>
              </div>
            </div>

            <hr class="my-4">

            <button id="confirmar" class="w-100 btn btn-success btn-lg" type="submit">Confirmar</button>
        </div>
      </div>
    </main>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="{{ asset('js/pagamento.js') }}" type="text/javascript" async="true" defer></script>

</body>
</html>