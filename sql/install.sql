CREATE TABLE IF NOT EXISTS `civicrm_membership_period` (
  `id` INT(200) AUTO_INCREMENT,
  `start_date` date,
  `end_date` date,
  `membership_id` int(200),
  `contribution_id` int(200),
  `renewed_date` datetime,
  PRIMARY KEY (`id`)
);