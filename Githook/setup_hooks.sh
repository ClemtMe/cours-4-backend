#!/bin/bash

# Copie les hooks dans le dossier .git/hooks
cp Githook/pre-commit .git/hooks/pre-commit.sh
cp Githook/pre-push .git/hooks/pre-push.sh

# Rend les hooks exécutables
chmod +x .git/hooks/pre-commit.sh
chmod +x .git/hooks/pre-push.sh

echo "✅ Hooks Git installés avec succès !"
