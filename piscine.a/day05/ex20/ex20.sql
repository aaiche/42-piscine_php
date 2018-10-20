SELECT
db_aaiche.film.id_genre,
db_aaiche.genre.nom AS 'nom genre',
db_aaiche.film.id_distrib,
db_aaiche.distrib.nom AS 'nom distrib',
db_aaiche.film.titre AS 'titre film'
FROM
db_aaiche.film
LEFT OUTER JOIN db_aaiche.genre
ON db_aaiche.film.id_genre = db_aaiche.genre.id_genre 
LEFT OUTER JOIN db_aaiche.distrib
ON db_aaiche.film.id_distrib = db_aaiche.distrib.id_distrib
WHERE db_aaiche.film.id_genre BETWEEN 4 AND 8;

