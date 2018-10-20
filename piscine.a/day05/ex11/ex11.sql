SELECT 
   UPPER(db_aaiche.fiche_personne.nom) AS 'NOM',
   db_aaiche.fiche_personne.prenom,
   db_aaiche.abonnement.prix
FROM
   db_aaiche.membre
JOIN 
   db_aaiche.fiche_personne
ON 
   db_aaiche.membre.id_fiche_perso = db_aaiche.fiche_personne.id_perso 
JOIN 
   db_aaiche.abonnement
ON 
   db_aaiche.membre.id_abo = db_aaiche.abonnement.id_abo
WHERE 
   db_aaiche.abonnement.prix > 42 ORDER BY db_aaiche.fiche_personne.nom ASC, db_aaiche.fiche_personne.prenom ASC;
