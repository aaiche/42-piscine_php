SELECT db_aaiche.film.titre, db_aaiche.film.resum 
FROM db_aaiche.film 
WHERE db_aaiche.film.titre LIKE '%42%' OR db_aaiche.film.resum LIKE '%42%' 
ORDER BY db_aaiche.film.duree_min ASC;
