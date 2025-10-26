# 👾 API COM PHP PURO 💤

Esta API tem apenas como objetivo explorar as funcionalidades nativas de PHP para criar uma api.

# ✈️ Endpoints e Parametros
Envie esses parametros em raw

### 💹 POST: /media
```
    {
        "endpoint": "media",
        "valores": [1, 5, 8, 11]
    }
```

### ⚙️ POST: /tabuada
```
    {
        "endpoint": "tabuada",
        "numero": 5
    }
```

### 🔗 POST: /inverter
```
    {
        "endpoint": "inverter",
        "texto": "Olá, seja bem vindo!"
    }
```

## 📚 Anotações de estudo

### 🧾 php://input
Isso lê o body da requisição exatamente como ele veio.
```
    file_get_contents('php://input');
```
Utilizamos para acessar o corpo cru (raw) da requisição HTTP.
Quando enviamos via POST com JSON, o PHP não coloca os dados automaticamnete em $_POST
(isso só acontece com formulários x-www-form-urlencoded).


### 🗝️ json_decode()
Depois de lermos o JSON como texto cru, precisamos convertêlo para um array, ou objeto:

```
    $input = json_decode(file_get_contents('php://input'), true);
```
O true no final faz o php retornar um array associativo. Sem o true, o resultado seria um objeto.

### 🔒 json_encode()
No final da execução, a API precisa respnder um JSON.

```
    echo json_encode($dados, JSON_UNESCAPED_UNICODE);
```
Ele vai pegar um array ou objeto PHP e transformar em texto JSON.

### 📩 JSON_UNESCAPED_UNICODE
Esse parâmetro faz com que os caracteres Unicode não seja escapados.

Sem JSON_UNESCAPED_UNICODE:
```
    { "mensagem": "Ol\u00e1, Brendon!" }
```

Com JSON_UNESCAPED_UNICODE:
```
    { "mensagem": "Olá, Brendon!" }
```