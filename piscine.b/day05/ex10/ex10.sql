SELECT db_aaiche.film.title AS 'Title', film.summary AS 'Summary', film.prod_year 
FROM db_aaiche.film 
INNER JOIN db_aaiche.genre ON film.id_genre=genre.id_genre 
WHERE genre.name='erotic' 
ORDER BY prod_year DESC;
