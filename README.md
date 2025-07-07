# ProdStore
# Setup do Projeto Laravel

## 1. Pré-requisitos

- PHP `^8.2`
- [Composer](https://getcomposer.org/)
- MySQL ou SQLite

---

## 2. Configuração

### Extensões PHP necessárias

Verifique se as seguintes extensões estão habilitadas no seu `php.ini` (remova o `;`):

- `bz2`
- `fileinfo`
- `mbstring`
- `openssl`
- `pdo_mysql` ou `pdo_sqlite`
- `zip`

### Arquivo `.env` deve ser criado a partir de um cópia do `.emv.exemple`

------------------------------------------------------------------
---
---

# API E-Commerce

API desenvolvida com foco em boas práticas e arquitetura escalável.

---

## Arquiteturas utilizadas

- ✅ **DTO** (Data Transfer Object)
- ✅ **Services**
- ✅ **Repositories**

---

## Funcionalidades 

### CRUD
- Produtos
- Usuários (para login e autenticação)

### Processo de Reset Password ---

### Validação
- Todos os endpoints protegidos e validados via **FormRequest**

### Paginação e Filtros
Filtros disponíveis via `paginate()`:

- `title`
- `description`
- `category`
- `with_image`

### Importação externa
- Comando Artisan que consome a **Fake Store API** para importar produtos automaticamente:

```bash

php artisan product-action:import --id=1

php artisan product-action:import --id=1 --offline


