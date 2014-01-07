-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2009 年 08 月 19 日 19:47
-- 服务器版本: 5.5.27
-- PHP 版本: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `cafa-c`
--

-- --------------------------------------------------------

--
-- 表的结构 `c_user`
--

CREATE TABLE IF NOT EXISTS `c_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `mail` varchar(128) NOT NULL,
  `state` int(2) NOT NULL DEFAULT '1',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `c_user`
--

INSERT INTO `c_user` (`id`, `name`, `password`, `mail`, `state`, `createtime`) VALUES
(1, '毕加波', '9d87bedc7a9927a3bafc2f12a04a499a', 'bijiabo@gmail.com', 1, '2013-10-28 14:26:57'),
(9, '杉鸥', '9d87bedc7a9927a3bfc2f12a04a499a', '124152400@qq.com', 1, '2013-10-28 14:21:59'),
(10, 'PCBaike', '8732d95f7b8a755f9673501de6baf000', 'hu@pcbaike.com', 1, '2013-10-28 13:41:03');

-- --------------------------------------------------------

--
-- 表的结构 `c_weibolist`
--

CREATE TABLE IF NOT EXISTS `c_weibolist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `content` int(11) NOT NULL,
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `state` int(2) NOT NULL DEFAULT '1',
  `type` varchar(64) NOT NULL DEFAULT 'text' COMMENT '微博类型',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微博列表' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
