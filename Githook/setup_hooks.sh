#!/bin/bash

# Copie les hooks dans le dossier .git/hooks
cp Githook/pre-commit .git/hooks/pre-commit
cp Githook/pre-push .git/hooks/pre-push

# Rend les hooks exécutables
chmod +x .git/hooks/pre-commit
chmod +x .git/hooks/pre-push

echo "✅ Hooks Git installés avec succès !"
