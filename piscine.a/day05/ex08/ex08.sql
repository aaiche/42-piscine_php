SELECT nom, prenom, DATE(date_naissance) AS 'date de naissance' 
FROM db_aaiche.fiche_personne 
WHERE YEAR(date_naissance) = 1989 
ORDER BY nom ASC;
