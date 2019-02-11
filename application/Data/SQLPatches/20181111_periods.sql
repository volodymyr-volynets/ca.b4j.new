UPDATE b4_periods c
SET
	c.b4_period_new_registrations = (SELECT COUNT(*) FROM b4_register a WHERE (a.b4_register_status_id = 10 OR a.b4_register_status_id = 20) AND a.b4_register_period_id = c.b4_period_id),
	c.b4_period_confirmed_registrations = (SELECT COUNT(*) FROM b4_register b WHERE b.b4_register_status_id = 20 AND b.b4_register_period_id = c.b4_period_id);