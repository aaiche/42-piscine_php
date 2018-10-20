SELECT db_aaiche.film.title, db_aaiche.film.summary 
FROM db_aaiche.film 
WHERE db_aaiche.film.title LIKE '%42%' OR db_aaiche.film.summary LIKE '%42%' 
ORDER BY db_aaiche.film.duration ASC;
