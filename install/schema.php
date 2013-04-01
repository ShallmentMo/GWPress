<?php
$db->query('SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";');
//create table options
$db->query("CREATE TABLE IF NOT EXISTS options (
  option_id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  option_name varchar(64) COLLATE utf8_bin NOT NULL,
  option_value longtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (option_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;");
//create table pages
$db->query("CREATE TABLE IF NOT EXISTS pages (
  page_id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  page_title varchar(256) COLLATE utf8_bin NOT NULL,
  page_content longtext COLLATE utf8_bin NOT NULL,
  page_template varchar(256) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (page_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=17 ;");
//create table page_metas
$db->query("CREATE TABLE IF NOT EXISTS page_metas (
  page_meta_id bigint(20) NOT NULL AUTO_INCREMENT,
  page_id bigint(20) NOT NULL,
  page_meta_name varchar(256) COLLATE utf8_bin NOT NULL,
  page_meta_value longtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (page_meta_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=28 ;");
//create table users
$db->query("CREATE TABLE IF NOT EXISTS users (
  user_id bigint(20) NOT NULL AUTO_INCREMENT,
  user_login varchar(60) COLLATE utf8_bin NOT NULL,
  user_pass varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (user_id),
  UNIQUE KEY user_login (user_login)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;");
//create table user_metas
$db->query("CREATE TABLE IF NOT EXISTS user_metas (
  user_meta_id bigint(20) NOT NULL AUTO_INCREMENT,
  user_id bigint(20) NOT NULL,
  user_meta_name varchar(255) COLLATE utf8_bin NOT NULL,
  user_meta_value longtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (user_meta_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;");
//insert into options
$db->query("INSERT INTO options (option_id,option_name, option_value) VALUES
(1,'siteurl', '$site_url'),
(2,'active_plugins', ''),
(3,'applied_theme', 'default'),
(5,'site_name', '$site_name'),
(6,'site_description','$site_decs'),
(7,'html_type', 'text/html'),
(8,'site_charset', 'UTF-8'),
(9,'gmt_offset', 8);");
$db->query('INSERT INTO options (option_id,option_name, option_value) VALUES
(4,"menu_nav",\'a:2:{i:0;s:6:"首页";i:1;s:12:"关于我们";}\');');
$db->query('INSERT INTO page_metas (page_meta_id, page_id, page_meta_name, page_meta_value) VALUES
(1, 1, "menu", "首页"),
(2, 2, "menu", "关于我们");');
$db->query("INSERT INTO pages (page_id,page_title, page_content, page_template) VALUES
(1, 'Home', 'Welcome to GWPress','index'),
(2, 'about me','It is GWPress','about');");
$db->query("INSERT INTO users (user_id, user_login, user_pass) VALUES
(1, '$username','$password');");
?>