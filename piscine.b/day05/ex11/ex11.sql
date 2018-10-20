SELECT 
   UPPER(db_aaiche.user_card.last_name) AS 'NAME',
   db_aaiche.user_card.first_name,
   db_aaiche.subscription.price
FROM
   db_aaiche.member
JOIN 
   db_aaiche.user_card
ON 
   db_aaiche.member.id_user_card = db_aaiche.user_card.id_user
JOIN 
   db_aaiche.subscription
ON 
   db_aaiche.member.id_sub = db_aaiche.subscription.id_sub
WHERE 
   db_aaiche.subscription.price > 42 ORDER BY db_aaiche.user_card.last_name ASC, db_aaiche.user_card.first_name ASC;
