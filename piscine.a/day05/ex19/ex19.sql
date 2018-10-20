SELECT
	ABS(
		DATEDIFF(
			LEAST(
				MIN( db_aaiche.membre.date_dernier_film ),
				MIN( db_aaiche.historique_membre.date ) 
			),
			GREATEST(
				MAX( db_aaiche.membre.date_dernier_film ),
				MAX( db_aaiche.historique_membre.date ) 
			) 
		) 
	) AS ‘uptime’ 
FROM
	db_aaiche.historique_membre,
	db_aaiche.membre
;
