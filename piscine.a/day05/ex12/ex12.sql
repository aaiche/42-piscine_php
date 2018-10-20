SELECT
db_aaiche.fiche_personne.nom,
db_aaiche.fiche_personne.prenom
FROM
db_aaiche.fiche_personne
WHERE
db_aaiche.fiche_personne.nom LIKE '%-%' OR db_aaiche.fiche_personne.prenom LIKE '%-%'
ORDER BY db_aaiche.fiche_personne.nom, db_aaiche.fiche_personne.prenom;
