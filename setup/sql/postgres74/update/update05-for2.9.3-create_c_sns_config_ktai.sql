CREATE TABLE c_sns_config_ktai (
  c_sns_config_ktai_id serial NOT NULL,
  key_name varchar(64) NOT NULL default '',
  bg_01 text NOT NULL,
  bg_02 text NOT NULL,
  bg_03 text NOT NULL,
  bg_04 text NOT NULL,
  bg_05 text NOT NULL,
  bg_06 text NOT NULL,
  bg_07 text NOT NULL,
  border_01 text NOT NULL,
  border_02 text NOT NULL,
  border_03 text NOT NULL,
  font_01 text NOT NULL,
  font_02 text NOT NULL,
  font_03 text NOT NULL,
  PRIMARY KEY  (c_sns_config_ktai_id),
  UNIQUE (key_name)
);

INSERT INTO c_sns_config_ktai VALUES (nextval('c_sns_config_ktai_c_sns_config_ktai_id_seq'), 'current', '0D6DDF', 'DDDDDD', 'EEEEFF', '7DDADF', 'E0EAEF', 'C49FFF', 'DCD1EF', '0D6DDF', 'B3CEEF', 'BFA4EF', 'EEEEEE', '999966', '0C5F0F');

INSERT INTO c_sns_config_ktai VALUES (nextval('c_sns_config_ktai_c_sns_config_ktai_id_seq'), 'default', '0D6DDF', 'DDDDDD', 'EEEEFF', '7DDADF', 'E0EAEF', 'C49FFF', 'DCD1EF', '0D6DDF', 'B3CEEF', 'BFA4EF', 'EEEEEE', '999966', '0C5F0F');
