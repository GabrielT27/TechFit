<?php
/**
 * GUIA DE CONFIGURAÇÃO - TechFit
 * 
 * Este arquivo contém instruções e configurações adicionais
 */

// ============================================
// 1. CONFIGURAÇÃO DE CONEXÃO COM BANCO DE DADOS
// ============================================

/*
Arquivo: config/Database.php

As configurações padrão são:
- host: localhost
- db_name: techfit_db
- db_user: root
- db_pass: (vazio)

Se você usar XAMPP com senha, altere para:
private $db_pass = 'sua_senha_aqui';

Se usar outro host, altere:
private $host = 'seu.host.com';
*/

// ============================================
// 2. ESTRUTURA DE PASTAS
// ============================================

/*
TechFit/
│
├── app/                          # Aplicação Principal
│   ├── models/                   # Modelos de dados
│   │   ├── User.php              # Modelo de Usuário
│   │   ├── Membro.php            # Modelo de Membro
│   │   └── Pagamento.php         # Modelo de Pagamento
│   │
│   ├── controllers/              # Controladores
│   │   ├── UserController.php    # Controlador de Usuário
│   │   ├── MembroController.php  # Controlador de Membro
│   │   └── PagamentoController.php # Controlador de Pagamento
│   │
│   └── views/                    # Visualizações (Templates)
│       ├── layout/               # Layout padrão
│       │   ├── header.php        # Cabeçalho
│       │   └── footer.php        # Rodapé
│       │
│       ├── dashboard.php         # Página inicial
│       │
│       ├── usuarios/             # Views de Usuários
│       │   ├── index.php         # Listar usuários
│       │   ├── create.php        # Formulário criar
│       │   └── edit.php          # Formulário editar
│       │
│       ├── membros/              # Views de Membros
│       │   ├── index.php         # Listar membros
│       │   ├── create.php        # Formulário criar
│       │   └── edit.php          # Formulário editar
│       │
│       └── pagamentos/           # Views de Pagamentos
│           ├── index.php         # Listar pagamentos
│           ├── create.php        # Formulário criar
│           ├── edit.php          # Formulário editar
│           └── relatorio.php     # Relatório
│
├── config/                       # Configurações
│   ├── Database.php              # Classe de conexão
│   └── init.php                  # Inicialização da app
│
├── Downloads/
│   └── BDTechFit/
│       └── setup.sql             # Script SQL
│
├── index.php                     # Arquivo principal
├── README.md                     # Documentação
└── SETUP.php                     # Este arquivo
*/

// ============================================
// 3. ROTAS DA APLICAÇÃO
// ============================================

/*
BASE: http://localhost/TechFit/

DASHBOARD:
- http://localhost/TechFit/
- http://localhost/TechFit/?module=dashboard

USUÁRIOS:
- http://localhost/TechFit/?module=usuarios              # Listar
- http://localhost/TechFit/?module=usuarios&action=create # Criar
- http://localhost/TechFit/?module=usuarios&action=edit&id=1 # Editar
- http://localhost/TechFit/?module=usuarios&action=delete&id=1 # Deletar

MEMBROS:
- http://localhost/TechFit/?module=membros               # Listar
- http://localhost/TechFit/?module=membros&action=create # Criar
- http://localhost/TechFit/?module=membros&action=edit&id=1 # Editar
- http://localhost/TechFit/?module=membros&action=delete&id=1 # Deletar

PAGAMENTOS:
- http://localhost/TechFit/?module=pagamentos            # Listar
- http://localhost/TechFit/?module=pagamentos&action=create # Criar
- http://localhost/TechFit/?module=pagamentos&action=edit&id=1 # Editar
- http://localhost/TechFit/?module=pagamentos&action=delete&id=1 # Deletar
- http://localhost/TechFit/?module=pagamentos&action=relatorio # Relatório
*/

// ============================================
// 4. FLUXO MVC
// ============================================

/*
1. REQUISIÇÃO (index.php)
   ↓
2. ROUTER - Identifica módulo e ação
   ↓
3. CONTROLLER - Executa lógica
   ↓
4. MODEL - Acessa banco de dados
   ↓
5. VIEW - Retorna HTML ao usuário

Exemplo: Listar Usuários
1. URL: ?module=usuarios
2. Router chama: UserController->index()
3. Controller chama: $user->getAll()
4. Model consulta: SELECT * FROM usuarios
5. View exibe: tabela com usuários
*/

// ============================================
// 5. PADRÃO DE VALIDAÇÃO
// ============================================

/*
Usuários:
- Nome: obrigatório
- Email: obrigatório, formato válido, único
- Telefone: obrigatório
- Endereço: obrigatório

Membros:
- Usuário: obrigatório (existe na tabela usuarios)
- Tipo de Plano: bronze, prata, ouro
- Data Início: obrigatória
- Data Fim: opcional
- Status: ativo, inativo, suspenso

Pagamentos:
- Membro: obrigatório (existe na tabela membros)
- Valor: obrigatório, número positivo
- Data Pagamento: obrigatória
- Método: cartao, boleto, dinheiro, pix
- Status: pago, pendente, cancelado
- Descrição: opcional
*/

// ============================================
// 6. AUTENTICAÇÃO (ADICIONAL)
// ============================================

/*
Para adicionar autenticação:

1. Criar tabela: admin (id, usuario, senha, data_cadastro)

CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

2. Criar arquivo: app/controllers/AuthController.php

3. Modificar header.php para verificar sessão

4. Adicionar login antes de acessar módulos
*/

// ============================================
// 7. BACKUP DO BANCO DE DADOS
// ============================================

/*
No MySQL/phpMyAdmin:

1. Abrir banco: techfit_db
2. Clicar em: Exportar
3. Selecionar: SQL
4. Clicar em: Ir

Ou via linha de comando:

mysqldump -u root -p techfit_db > backup.sql

Restaurar:

mysql -u root -p techfit_db < backup.sql
*/

// ============================================
// 8. LOGS DE ERROS
// ============================================

/*
Para ativar logs de erros, adicione no início do index.php:

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error_log.txt');
*/

// ============================================
// 9. EXTENDER A APLICAÇÃO
// ============================================

/*
Para adicionar novo módulo (ex: Aulas):

1. Criar: app/models/Aula.php
   class Aula {
       private $db;
       private $table = 'aulas';
       
       // métodos CRUD
   }

2. Criar: app/controllers/AulaController.php
   class AulaController {
       // métodos index, create, store, etc
   }

3. Criar views em: app/views/aulas/
   - index.php
   - create.php
   - edit.php

4. Adicionar no index.php:
   case 'aulas':
       $controller = new AulaController();
       routeAction($controller, $action);
       break;

5. Adicionar link no header.php:
   <a class="nav-link" href="?module=aulas">Aulas</a>

6. Criar tabela no banco de dados
*/

// ============================================
// 10. MELHORIAS FUTURAS
// ============================================

/*
- Autenticação e autorização
- Sistema de papéis (admin, recepcionista, etc)
- Relatórios em PDF
- Envio de email
- API REST
- Gráficos e análises avançadas
- Integração com gateway de pagamento
- Sistema de agendamento
- Histórico de alterações
- Backup automático
*/
