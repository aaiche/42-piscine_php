SELECT db_aaiche.film.titre AS 'Titre', film.resum AS 'Resume', film.annee_prod 
FROM db_aaiche.film 
INNER JOIN db_aaiche.genre ON film.id_genre=genre.id_genre 
WHERE genre.nom='erotic' 
ORDER BY annee_prod DESC;
