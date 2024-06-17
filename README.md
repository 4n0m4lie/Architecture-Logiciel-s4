# Architecture-Logiciel-s4

## Membre du groupe
 - [Clément Nétange](https://github.com/clem-png)
 - [Tom Fouquet](https://github.com/Tom-FOUQUET)
 - [Mathias Ringot](https://github.com/4n0m4lie)

## Répartition du travail

> [!NOTE]
> Mathias Ringot apparait moins car il c'est de taches non visible ici (docker compose en avance, création et remodelage de twig ou encore du style)

### Sujet de TD

- TD1 : CLEMENT NETANGE
- TD2 :
    - exo 1 : TOM FOUQUET
    - exo 2 : CLEMENT NETANGE
- TD3 :
    - exo 1 et 4 : CLEMENT NETANGE
    - exo 2 et 3: TOM FOUQUET
- TD4 :
    - exo 1 et 3 : CLEMENT NETANGE
    - exo 2 et 4 : MATHIAS RINGOT
- TD5 :
    - exo 1 : CLEMENT NETANGE + TOM FOUQUET
    - exo 2 : CLEMENT NETANGE + TOM FOUQUET + MATHIAS RINGOT
- TD6 : 
    - exo 1 et 2 : CLEMENT NETANGE
    - exo 3 : TOM FOUQUET
- TD7 : CLEMENT NETANGE
- TD8 : MATHIAS RINGOT

### Sujet détaillé 

1. CLEMENT NETANGE + TOM FOUQUET
2. CLEMENT NETANGE + TOM FOUQUET
3. CLEMENT NETANGE + TOM FOUQUET
4. CLEMENT NETANGE
5. TOM FOUQUET
6. CLEMENT NETANGE
7. CLEMENT NETANGE
8. CLEMENT NETANGE
9. TOM FOUQUET
10. TOM FOUQUET
11. CLEMENT NETANGE
12. CLEMENT NETANGE
13. TOM FOUQUET
14. TOM FOUQUET
15. CLEMENT NETANGE
16. CLEMENT NETANGE
17. CLEMENT NETANGE
18. CLEMENT NETANGE
19. CLEMENT NETANGE
20. CLEMENT NETANGE
21. MATHIAS RINGOT
22. MATHIAS RINGOT
23. MATHIAS RINGOT
24. MATHIAS RINGOT


## Installation

### Windows

  - Prérequis : 
    - Installer [Docker Desktop](https://www.docker.com/products/docker-desktop)
    - Installer [Git](https://git-scm.com/download/win)
    - Installer [Composer](https://getcomposer.org/download/)

  - Installation :
    - Ouvrir un terminal
    - Cloner le projet : `git clone git@github.com:4n0m4lie/Architecture-Logiciel-s4.git`
    - Se déplacer dans le dossier du projet : `cd Architecture-Logiciel-s4`
    - Puis aller dans giftbox/gift.api et giftbox/gift.appli et executer la commande `composer install`
    - Assurer vous d'avoir les ports 15080, 15443, 15280, 15643 et 3606 de libre
    - Ensuite revenir à la racine du projet pour lancer le docker-compose : `docker-compose up -d`
    - Enfin, ouvrir un navigateur et aller sur [localhost:15080](http://localhost:15080)
    - Pour stopper le projet : `docker-compose down`

### Linux

  - Prérequis : 
    - Installer [Docker](https://docs.docker.com/engine/install/ubuntu/)
    - Installer [Docker Compose](https://docs.docker.com/compose/install/)
    - Installer [Git](https://git-scm.com/download/linux)
    - Installer [Composer](https://getcomposer.org/download/)
    
  - Installation :
    - Ouvrir un terminal
    - Cloner le projet : `git clone git@github.com:4n0m4lie/Architecture-Logiciel-s4.git`
    - Se déplacer dans le dossier du projet : `cd Architecture-Logiciel-s4`
    - Puis aller dans giftbox/gift.api et giftbox/gift.appli et executer la commande `composer install`
    - Assurer vous d'avoir les ports 15080, 15443, 15280, 15643 et 3606 de libre
    - Ensuite revenir à la racine du projet pour lancer le docker-compose : `docker compose up -d`
    - Enfin, ouvrir un navigateur et aller sur [localhost:15080](http://localhost:15080)
    - Pour stopper le projet : `docker compose down`

