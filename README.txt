WEBOTECA CLÁSSICA - PROJETO FATEC

SISTEMA
Sistema PHP + MySQL para cadastro de sites favoritos.

FUNCIONALIDADES
- Login com sessão.
- Dois perfis: administrador e usuário.
- Somente administrador cadastra, altera e exclui usuários.
- Usuário possui interface própria de perfil.
- CRUD completo de sites favoritos.
- Cada site possui: nome, URL, descrição, categoria, data de cadastro e foto.
- Fotos armazenadas na pasta uploads.
- Busca por nome, URL ou descrição.
- Filtro por categoria.
- Senhas protegidas com password_hash/password_verify.

BANCO DE DADOS
1. Abra o XAMPP e ligue Apache e MySQL.
2. Acesse o phpMyAdmin.
3. Importe o arquivo _SQL/weboteca.sql.
4. Coloque a pasta fatec_weboteca em C:\xampp\htdocs\ (ou dentro da pasta htdocs).
5. Abra http://localhost/fatec_weboteca/

INTERFACE EXISTENTE UTILIZADA
A interface visual foi baseada/adaptada no conceito de temas prontos do Bootswatch:
https://bootswatch.com/

A identidade visual foi modificada para o tema "clássico/antigo", com tipografia serifada, bordas duplas, tons de papel, marrom e bege. A interface não é uma cópia integral do template; ela foi adaptada ao sistema e às necessidades da atividade.

OBSERVAÇÃO ACADÊMICA
O sistema foi organizado para demonstrar CRUD, autenticação, controle de acesso, banco de dados, upload de imagens e relacionamento entre usuários e sites favoritos.
