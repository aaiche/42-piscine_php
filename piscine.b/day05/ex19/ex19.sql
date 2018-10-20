SELECT
	ABS(
		DATEDIFF(
			LEAST(
				MIN( db_aaiche.member.date_last_film ),
				MIN( db_aaiche.member_history.date ),
				MIN( db_aaiche.film.last_projection ) 
			),
			GREATEST(
				MAX( db_aaiche.member.date_last_film ),
				MAX( db_aaiche.member_history.date ), 
				MAX( db_aaiche.film.last_projection ) 
			) 
		) 
	) AS ‘uptime’ 
FROM
	db_aaiche.member_history,
	db_aaiche.member,
	db_aaiche.film
;
