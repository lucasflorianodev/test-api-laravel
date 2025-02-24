# 🚀 Projeto Laravel com Docker e PostgreSQL

Este projeto é uma aplicação Laravel configurada para rodar em um ambiente Docker com PostgreSQL, utilizando Laravel Sail para facilitar o desenvolvimento.

## 📌 Requisitos
Antes de começar, certifique-se de ter instalado:
- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Git](https://git-scm.com/)

## ⚙️ Configuração do Projeto

1. **Clone o repositório:**
   ```sh
   git clone https://github.com/seu-usuario/seu-repositorio.git
   cd seu-repositorio
   ```

2. **Copie o arquivo de exemplo de ambiente:**
   ```sh
   cp .env.example .env
   ```

3. **Suba os containers do Docker:**
   ```sh
   ./vendor/bin/sail up -d
   ```

4. **Instale as dependências do Laravel:**
   ```sh
   ./vendor/bin/sail composer install
   ```

5. **Gere a chave da aplicação:**
   ```sh
   ./vendor/bin/sail artisan key:generate
   ```

6. **Rode as migrações para criar o banco de dados:**
   ```sh
   ./vendor/bin/sail artisan migrate
   ```

7. **Acesse a aplicação no navegador:**
   ```
   http://localhost
   ```

## 🛠 Comandos Úteis

- **Parar os containers:**
  ```sh
  ./vendor/bin/sail down
  ```

- **Acessar o container do Laravel:**
  ```sh
  ./vendor/bin/sail shell
  ```

- **Rodar testes:**
  ```sh
  ./vendor/bin/sail artisan test
  ```

## 📜 Licença
Este projeto é distribuído sob a licença MIT. Sinta-se à vontade para usá-lo e modificá-lo conforme necessário. 🚀

