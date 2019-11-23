create database if not exists lottery_db;
use lottery_db;

create table if not exists `lottery` (
`id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
`code` int(10) unsigned not null default 0 comment '期号',
`date` varchar(20) not null comment '开奖日期',
`red` varchar(20) not null default '' comment '红球开奖号',
`blue` tinyint(3) unsigned not null default 0 comment '蓝球开奖号',
`sales` int(10) unsigned not null default 0 comment '销量',
`poolmoney` int(10) unsigned not null default 0 comment '奖池',
`content` varchar(100) not null default '' comment '一等奖分布',
PRIMARY KEY (`id`),
UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='彩票双色球';

create table if not exists `lottery_detail` (
`id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
`code` int(10) unsigned not null default 0 comment '期号',
`type` tinyint(3) unsigned not null default 0 comment '中奖类型',
`count` bigint(20) unsigned not null default 0 comment '中奖数量',
`money` bigint(20) unsigned not null default 0 comment '中奖金额',
PRIMARY KEY (`id`),
UNIQUE KEY `code_type` (`code`, `type`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='彩票双色球中奖金额';
