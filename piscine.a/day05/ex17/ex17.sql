SELECT COUNT(*) AS 'nb_abo',
FLOOR(AVG(db_aaiche.abonnement.prix)) AS 'moy_abo',
(SUM(db_aaiche.abonnement.duree_abo) MOD 42) AS 'ft'
FROM db_aaiche.abonnement;
