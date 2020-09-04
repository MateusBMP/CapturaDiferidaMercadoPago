# CapturaDiferidaMercadoPago

Testa a captura de um valor via Mercado Pago. Para testar o código, primeiro instale as dependências:

```sh
$ composer install
```

Agora crie o arquivo `.env` e insira seu Access Token do ambiente sandbox:

```sh
$ cp .env.example .env
```

Finalmente, execute o arquivo `captura-diferida.php`:

```sh
$ php captura-diferida.php
```
