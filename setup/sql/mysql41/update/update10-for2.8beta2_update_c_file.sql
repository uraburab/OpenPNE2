/*!40101 SET NAMES utf8 */;

ALTER TABLE c_file DROP COLUMN type;
ALTER TABLE c_file ADD (original_filename text);