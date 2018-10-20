INSERT INTO db_aaiche.ft_table
  (login, date_de_creation, groupe)
SELECT nom, date_naissance, 'other' 
FROM db_aaiche.fiche_personne 
WHERE nom LIKE '%a%' AND CHAR_LENGTH(nom) < 9 
ORDER BY nom ASC LIMIT 10;

