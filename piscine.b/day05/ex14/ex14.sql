SELECT
db_aaiche.cinema.floor_number AS 'floor',
SUM(db_aaiche.cinema.nb_seats) AS 'seats'
FROM
db_aaiche.cinema
GROUP BY floor_number
ORDER BY 
SUM(db_aaiche.cinema.nb_seats) DESC;
