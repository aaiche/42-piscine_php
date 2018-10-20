SELECT
db_aaiche.film.id_genre,
db_aaiche.genre.name AS 'name_genre',
db_aaiche.film.id_distrib,
db_aaiche.distrib.name AS 'name_distrib',
db_aaiche.film.title AS 'title_film'
FROM
db_aaiche.film
LEFT OUTER JOIN db_aaiche.genre
ON db_aaiche.film.id_genre = db_aaiche.genre.id_genre 
LEFT OUTER JOIN db_aaiche.distrib
ON db_aaiche.film.id_distrib = db_aaiche.distrib.id_distrib
WHERE db_aaiche.film.id_genre BETWEEN 4 AND 8;

