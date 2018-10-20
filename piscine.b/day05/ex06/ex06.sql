SELECT db_aaiche.film.title, db_aaiche.film.summary
FROM db_aaiche.film 
WHERE LOWER(db_aaiche.film.summary) LIKE '%vincent%' 
ORDER BY db_aaiche.film.id_film ASC;
