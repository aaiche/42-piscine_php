SELECT
db_aaiche.salle.etage_salle AS 'etage',
SUM(db_aaiche.salle.nbr_siege) AS 'sieges'
FROM
db_aaiche.salle
GROUP BY etage_salle
ORDER BY 
SUM(db_aaiche.salle.nbr_siege) DESC;
