# Corporate Travel Management Microservice

Este projeto é um microsserviço desenvolvido em Laravel para gerenciar pedidos de viagem corporativa. O microsserviço expõe uma API REST para as seguintes operações:

- **Criar um pedido de viagem**: Um pedido deve incluir o ID do pedido, o nome do solicitante, o destino, a data de ida, a data de volta e o status (solicitado, aprovado, cancelado).
- **Atualizar o status de um pedido de viagem**: Possibilitar a atualização do status para "aprovado" ou "cancelado". (Nota: o usuário que fez o pedido não pode alterar o status do mesmo)
- **Consultar um pedido de viagem**: Retornar as informações detalhadas de um pedido de viagem com base no ID fornecido.
- **Listar todos os pedidos de viagem**: Retornar todos os pedidos de viagem cadastrados, com a opção de filtrar por status.
- **Cancelar pedido de viagem após aprovação**: Implementar uma lógica de negócios que verifique se é possível cancelar um pedido já aprovado.
- **Filtragem por período e destino**: Adicionar filtros para listar pedidos de viagem por período de tempo (ex: pedidos feitos ou com datas de viagem dentro de uma faixa de datas) e/ou por destino.
- **Notificação de aprovação ou cancelamento**: Sempre que um pedido for aprovado ou cancelado, uma notificação deve ser enviada para o usuário que solicitou o pedido.

## Instruções

### Pré requisitos

1. **Docker** e **docker compose** instalados. Para mais informações consultar a documentação oficial do Docker.

### Clone o repositório

1. Clone o repositório:
    ```sh
    git clone https://github.com/junionestor/corporate-travel.git
    cd corporate-travel
    ```

### Executar o Serviço Localmente (usando Docker)

1. Certifique-se de ter o Docker instalado e em execução.

2. Crie e inicie os containers:
    ```sh
    docker compose up -d
    ```

### Configurar o Ambiente

1. Copie o arquivo [.env.example](.env.example) para .env:
    ```sh
    cp .env.example .env
    ```

2. Instale as dependências:
    ```bash
    docker compose exec laravel.test composer install
    ```

3. Gere a chave da aplicação:
    ```sh
    vendor/bin/sail php artisan key:generate
    ```

4. Execute as migrations e os seeders do banco de dados:
    ```sh
    vendor/bin/sail php artisan migrate:fresh --seed
    ```

5. Pronto! A aplicação já está executando em http://localhost


### Executar os Testes

1. Execute os testes automatizados:
    ```sh
    vendor/bin/sail php artisan test
    ```

### Informações Adicionais

- Realize o registro de um usuário através do `/api/register`. Com o usuário é possível recuperar o token de acesso a aplicação através do `/api/login`.
- A documentação da API pode ser acessada em `/api/documentation`.
- Para enviar notificações, configure o serviço de e-mail no arquivo [.env].
