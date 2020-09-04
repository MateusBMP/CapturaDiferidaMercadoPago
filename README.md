# CapturaDiferidaMercadoPago

Testa a captura de um valor via Mercado Pago. Para testar o código, primeiro instale as dependências:

```sh
$ composer install
```

Agora crie o arquivo `.env` e insira seu Access Token do ambiente sandbox:

```sh
$ cp .env.example .env
```

> **Importante:** Insira seu access token entre aspas duplas (`""`). Exemplo: `ACCESS_TOKEN="APP_USR-4291..."`.

Finalmente, execute o arquivo `captura-diferida.php`:

```sh
$ php captura-diferida.php
```
