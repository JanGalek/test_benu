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

# Projekt

## Požadavky
Pro jednoduché a rychlé spuštění je nutné mít nainstalované:
- make
- docker / podman
- prohlížeč

Osobně používám podman, proto jsem využil make, který detekuje, zdali je nainstalován docker nebo podman.

## Spuštění
- `make requirements` 
- `make start`

aplikace je na adrese: http://127.0.0.1:8085/


## Příkazy
- `make requirements` - nainstaluje a stáhne vše potřebné (stáhne docker image, nainstaluje závislosti)
- `make start-dev` - spustí vývojovou aplikaci na portu 8085 (s NETTE_DEBUG)
- `make start` - spustí aplikace na portu 8085
- `make stop-dev` - zastaví vývojovou aplikaci
- `make stop` - zastaví aplikace
- `make tests` - spustí phpunit testy
- `make analyse` - spustí phpstan
- `make cs` - zkontroluje coding standards
- `make csf` - opraví opravitelné chyby podle coding standards
- `make qa` - spustí analyse a cs

### Pomocné
- `make vite-build` - zbuildí frontend aplikaci za pomocí vite (v dockeru)
- `make npm` - zdockerizované npm, lze použít pro instalaci dalších závislostí, atd... (pro přepínače je potřeba použít `--` před přepínači pro npm)
- `make npx` - zdockerizované npx, lze použít pro spouštění npx příkazů, atd... (pro přepínače je potřeba použít `--` před přepínači pro npx)