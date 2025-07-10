BENU Test
==========

Zadání
------
Napiš aplikaci, která si od uživatele vezme jako vstup číslo N a jejím výstupem bude multiplikační tabulka prvních N prvočísel.
Není potřeba dělat nic navíc, na druhou stranu se kreativitě meze nekladou :-) Ideálně nepoužívej chatGPT, protože to pak trochu postrádá smysl,
ale samozřejme to nemám moc jak poznat, takže spoléhám na Tvoji poctivost.

Požadavky:
- PHP - může být webová aplikace nebo klidně i konzolový skript
- použití OOP
- algoritmus na generování prvočísel napiš sám, není potřeba aby byl příliš sofistikovaný, ale nepoužívej žádnou knihovnu
- odevzdání ideálnì jako repozitář v githubu
- zamysli se nad tím, jak budu já aplikaci testovat, aby to pro mě bylo jednoduché (nápověda - docker)
  Bonusové body:
- dokumentace - jak mám postupovat, abych si aplikaci vyzkoušel
- unit testy - alespoň jeden užitečný unit test, který mohu jednoduše spustit (nápověda - composer scripts)
- nástroje na kontrolu code style a správnosti kódu, které mohu jednoduše spustit (nápověda - phpcs, phpstan)

## Příkazy

- `composer tests` / `make phpunit` - spustí phpunit testy

## Testy



## Spuštění
- `make requirements`
- `make start`

aplikace je na adrese: http://127.0.0.1:8085/

Nette Web Project
=================

Welcome to the Nette Web Project! This is a basic skeleton application built using
[Nette](https://nette.org), ideal for kick-starting your new web projects.

Nette is a renowned PHP web development framework, celebrated for its user-friendliness,
robust security, and outstanding performance. It's among the safest choices
for PHP frameworks out there.

If Nette helps you, consider supporting it by [making a donation](https://nette.org/donate).
Thank you for your generosity!


Requirements
------------

This Web Project is compatible with Nette 3.2 and requires PHP 8.1.


Installation
------------

To install the Web Project, Composer is the recommended tool. If you're new to Composer,
follow [these instructions](https://doc.nette.org/composer). Then, run:

	composer create-project nette/web-project path/to/install
	cd path/to/install

Ensure the `temp/` and `log/` directories are writable.


Asset Building with Vite
------------------------

This project supports Vite for asset building, which is recommended but optional. To activate Vite:

1. Uncomment the `type: vite` line in the `common.neon` configuration file under the assets mapping section.
2. Then set up and build the assets:

		npm install
		npm run build


Web Server Setup
----------------

To quickly dive in, use PHP's built-in server:

	php -S localhost:8000 -t www

Then, open `http://localhost:8000` in your browser to view the welcome page.

For Apache or Nginx users, configure a virtual host pointing to your project's `www/` directory.

**Important Note:** Ensure `app/`, `config/`, `log/`, and `temp/` directories are not web-accessible.
Refer to [security warning](https://nette.org/security-warning) for more details.


Minimal Skeleton
----------------

For demonstrating issues or similar tasks, rather than starting a new project, use
[minimal skeleton](https://github.com/nette/web-project/tree/minimal).
