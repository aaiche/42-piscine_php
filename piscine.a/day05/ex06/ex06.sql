SELECT db_aaiche.film.titre, db_aaiche.film.resum
FROM db_aaiche.film 
WHERE LOWER(db_aaiche.film.resum) LIKE '%vincent%' 
ORDER BY db_aaiche.film.id_film ASC;
