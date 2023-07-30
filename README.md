# unit-test-catch-me-if-you-can

Ce mini projet vise à mettre en place des tests unitaires avec PHPUnit.
Dans ce projet, nous avons créé un jeu simple avec une structure de projet bien organisée.

## Lancer tous les tests unitaires

```bash
composer tests
```

## Lancer les tests de la classe `Player`

```bash
composer test:player
```

## Lancer les tests de la classe `Board`

```bash
composer test:board
```

## Lancer les tests de la classe `Game`

```bash
composer test:game
```

# Tests Unitaires pour la Classe `Player`

Les tests unitaires de la classe `Player` sont conçus pour vérifier le bon fonctionnement des méthodes du joueur dans un environnement de jeu. Voici une brève description des différents tests effectués :

## 1. Test de l'Initialisation du Joueur

- **testPlayerInitialValues**: Vérifie que le joueur est correctement initialisé avec les valeurs spécifiées pour les coordonnées x et y et l'orientation.

## 2. Tests de Rotation du Joueur

- **testPlayerTurnLeftAt[Direction]Position**: Ces tests vérifient que le joueur tourne correctement à gauche depuis différentes orientations.
- **testPlayerTurnRightAt[Direction]Position**: Ces tests vérifient que le joueur tourne correctement à droite depuis différentes orientations.

## 3. Tests de Mouvement du Joueur

- **testPlayerMoveForward[Direction]**: Ces tests vérifient que le joueur avance correctement dans la direction spécifiée.

# Tests Unitaires pour la Classe `Board`

Les tests unitaires de la classe `Board` vérifient le bon fonctionnement des principales fonctionnalités de la grille de jeu, notamment l'initialisation, la validation de la position, le placement et le déplacement des joueurs.

## 1. Test de l'Initialisation de la Grille

- **testGridIsProperlyInitialized**: Vérifie que la grille est correctement initialisée avec 10 lignes, 10 colonnes, et que toutes les cellules sont initialisées à 0.

## 2. Test de la Validation de la Position

- **testIsValidPosition**: Teste la méthode `isValidPosition` pour s'assurer qu'elle renvoie `true` pour une position valide (5,5) sur la grille, et `false` pour des positions non valides (-2,5), (5,11), et (11,11).

## 3. Test du Placement du Joueur

- **testPlacePlayer**: Teste la méthode `placePlayer` pour vérifier si les joueurs sont correctement placés sur la grille aux positions spécifiées.

## 4. Test du Déplacement du Joueur

- **testMovePlayer**: Vérifie si la méthode `movePlayer` déplace correctement le joueur sur la grille, en mettant à jour l'ancienne position à `EMPTY` et en plaçant le joueur à la nouvelle position.

## 5. Test de l'Affichage de la Grille

- **testDisplay**: Teste la méthode `display` pour vérifier si la grille est correctement affichée en console, avec les joueurs aux bonnes positions.

# Tests Unitaires pour la Classe `Game`

Les tests se concentrent sur plusieurs aspects clés du jeu, y compris:

- **Initialisation du Jeu:** Vérifie que le jeu est correctement initialisé avec deux joueurs et un plateau.
- **Changement d'Orientation:** Teste la logique pour faire tourner les joueurs à gauche et à droite.
- **Déplacement des Joueurs:** Teste le déplacement en avant des joueurs dans toutes les orientations possibles (Nord, Est, Sud, Ouest).
- **Vision des Joueurs:** Vérifie si les joueurs peuvent ou non se voir dans différentes orientations et positions.
