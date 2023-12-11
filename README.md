# API Controle Pagamentos

Desenvolvimento de uma API que faz controle de pagamento pelas entregas realizadas.

## Instalação

Para a execução do PHP e do MySQL, resolvi utilizar o XAMPP para facilitar a execução do ambiente de desenvolvimento. Com essas ferramentas instaladas e configuradas corretamente, é necessário instalar as dependências do projeto, utilizando o Composer.

`composer install`

Faça uma cópia do arquivo .env.example na raiz do projeto e renomeie-o para .env. Abra o arquivo e configure as variáveis de ambiente relevantes, como as configurações de banco de dados.

`cp .env.example .env`

Com o arquivo de variáveis de ambiente configurado, é necessário preencher a chave de criptografia da aplicação, que é usada para proteger os dados criptografados.

`php artisan key:generate`

Com o ambiente instalado e configurado, precisamos migrar as migrations para o banco de dados com o comando abaixo.

`php artisan migrate`

Por fim, podemos executar o projeto e acessar no navegador, por padrão a url de acesso é http://localhost:8000.

`php artisan serve`

## Endpoints

De acordo com os requisitos do projeto, foram desenvolvidos dois endpoints para consulta das informações necessárias. Segue exemplo de uso com o [Postman](https://www.postman.com/anthonyleier/workspace/pblico/collection/24415316-e8e4f5b1-781b-4c67-9c6f-b197888692be?action=share&creator=24415316).

| Método | Endpoint          | Descrição                                                                                                                                   |
| ------ | ----------------- | ------------------------------------------------------------------------------------------------------------------------------------------- |
| GET    | /api/notas/{cnpj} | Retorna uma lista com todos os cálculos realizados para este usuário (valor_total, valor_ja_entregue, valor_nao_entregue e valor_em_atraso) |
| GET    | /api/notas        | Retorna a lista agrupada por CNPJ de todas as notas e suas informações                                                                      |

## Extras

No desenvolvimento da aplicação, além dos endpoints necessários para cumprir a tarefa proposta, também optei por desenvolver um CRUD de Usuários e Pagamentos. No entanto, após uma análise mais aprofundada do escopo do desafio, concluí que não fazia sentido incluí-los no projeto principal, mas deixo disponível para utilização caso queiram. Devo lembrar que o uso desses endpoints, necessita do banco de dados configurado.

### Usuários

| Método | Endpoint           | Descrição                                        |
| ------ | ------------------ | ------------------------------------------------ |
| POST   | /api/usuarios      | Cria um novo usuário                             |
| GET    | /api/usuarios      | Lista todos os usuários                          |
| GET    | /api/usuarios/{id} | Obtém os detalhes de um usuário específico       |
| PATCH  | /api/usuarios/{id} | Atualiza as informações de um usuário específico |
| DELETE | /api/usuarios/{id} | Exclui um usuário específico                     |

### Pagamentos

| Método | Endpoint             | Descrição                                          |
| ------ | -------------------- | -------------------------------------------------- |
| POST   | /api/pagamentos      | Cria um novo pagamento                             |
| GET    | /api/pagamentos      | Lista todos os pagamentos                          |
| GET    | /api/pagamentos/{id} | Obtém os detalhes de um pagamento específico       |
| PATCH  | /api/pagamentos/{id} | Atualiza as informações de um pagamento específico |
| DELETE | /api/pagamentos/{id} | Exclui um pagamento específico                     |

## Requisitos

-   Desenvolver em Laravel versão 6.0 ou superiores.
-   Utilizar Github para entrega do código.
-   Gerar uma collection no Postman, Swagger ou similares, para documentar sua API.
-   Entregar uma documentação com todos os passos para executar seu projeto e link do github.

## Tarefas

-   Agrupar as notas por remetente.
-   Calcular o valor total das notas para cada remetente.
-   Calcular o valor que o remetente irá receber pelo que já foi entregue.
-   Calcular o valor que o remetente irá receber pelo que ainda não foi entregue.
-   Calcular quanto o remetente deixou de receber devido ao atraso na entrega.
-   Gerar uma API com as informações de retorno.
-   Fazer controle de retorno com HTTP Response e HTTP Status Code.

## API Disponibilizada

A API está disponível em http://homologacao3.azapfy.com.br/api/ps/notas, onde os campos necessários estão exemplificados abaixo. Além disso, é importante lembrar que para o remetente receber por um produto, é necessário que o documento esteja entregue (COMPROVADO) e que a entrega tenha sido feita em no máximo dois dias após a sua data de emissão.

| Campo       | Descrição                                                                                                                                     |
| ----------- | --------------------------------------------------------------------------------------------------------------------------------------------- |
| chave       | Identificador único de uma nota fiscal                                                                                                        |
| numero      | Número da nota fiscal                                                                                                                         |
| cnpj_remete | Cnpj do distribuidor                                                                                                                          |
| nome_remete | Nome do distribuidor                                                                                                                          |
| cnpj_transp | Cnpj do transportador                                                                                                                         |
| nome_transp | Nome do transportador                                                                                                                         |
| dest        | Objeto com todas as informações do destinatário da entrega, o index “cod” é o identificador único do destinatário, podendo ser um cpf ou cnpj |
| status      | Status da nota define se o documento já foi entregue ou não (Aberto/Comprovado)                                                               |
| volumes     | Quantidade de volumes a ser entregue                                                                                                          |
| valor       | Valor o qual o destinatário pagará ao distribuidor pelo produto                                                                               |
| dt_emis     | Data de emissão do documento                                                                                                                  |
| dt_entrega  | Data de entrega da mercadoria                                                                                                                 |
