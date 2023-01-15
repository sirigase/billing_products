DROP TABLE billdetails;

CREATE TABLE `billdetails` (
  `name` varchar(30) DEFAULT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  `itemname` text DEFAULT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `invoiceno` varchar(30) NOT NULL,
  `grosstotal` varchar(10) NOT NULL,
  `cash` varchar(10) NOT NULL,
  `credit` varchar(10) NOT NULL,
  `price` varchar(30) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `saletype` varchar(30) DEFAULT NULL,
  `categoryname` varchar(150) NOT NULL,
  `itemqty` varchar(100) NOT NULL,
  `itemtype` varchar(100) NOT NULL,
  `sale` int(20) NOT NULL,
  `cashrecv` varchar(30) NOT NULL,
  `changem` varchar(30) NOT NULL,
  `cusid` varchar(30) NOT NULL,
  `date` varchar(20) NOT NULL,
  `discount` varchar(20) NOT NULL,
  `nettotal` varchar(20) NOT NULL,
  `advamt` varchar(20) NOT NULL,
  `advdeducted` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE category;

CREATE TABLE `category` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE credithistory;

CREATE TABLE `credithistory` (
  `invoiceno` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `grosstotal` varchar(10) NOT NULL,
  `cash` varchar(10) NOT NULL,
  `credit` varchar(10) NOT NULL,
  `saletype` varchar(30) DEFAULT NULL,
  `date` varchar(30) NOT NULL,
  `trans_date` date NOT NULL DEFAULT current_timestamp(),
  `givenamt` varchar(30) NOT NULL,
  `cusid` varchar(30) NOT NULL,
  `discount` varchar(20) NOT NULL,
  `nettotal` varchar(20) NOT NULL,
  `advamt` varchar(20) NOT NULL,
  `advdeducted` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE creditpurchasehistory;

CREATE TABLE `creditpurchasehistory` (
  `invoiceno` varchar(30) NOT NULL,
  `vendorname` varchar(100) NOT NULL,
  `totalamt` varchar(10) NOT NULL,
  `amtpaid` varchar(10) NOT NULL,
  `baldueamt` varchar(10) NOT NULL,
  `date` varchar(20) NOT NULL,
  `trans_date` date NOT NULL DEFAULT current_timestamp(),
  `addedamt` varchar(30) NOT NULL,
  `vid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE customer;

CREATE TABLE `customer` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `place` varchar(200) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `totalamtpurchased` varchar(10) DEFAULT NULL,
  `totalamtdue` varchar(10) DEFAULT NULL,
  `lasttransactiondate` varchar(20) DEFAULT NULL,
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `advamt` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE generate;

CREATE TABLE `generate` (
  `invoiceno` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `data` varchar(30) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`invoiceno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE generatepurchase;

CREATE TABLE `generatepurchase` (
  `invoiceno` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `data` varchar(30) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`invoiceno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE items;

CREATE TABLE `items` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `itemname` text DEFAULT NULL,
  `price` varchar(30) DEFAULT NULL,
  `categoryname` varchar(150) NOT NULL,
  `itemqty` varchar(30) NOT NULL,
  `itemtype` varchar(30) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE login;

CREATE TABLE `login` (
  `id` int(3) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO login VALUES("1","bheema","pass123");



DROP TABLE production;

CREATE TABLE `production` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `items` varchar(200) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `oilweight` varchar(100) DEFAULT NULL,
  `oilcakeweight` varchar(100) DEFAULT NULL,
  `wasteweight` varchar(100) DEFAULT NULL,
  `totalwt` varchar(100) NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE purchasebill;

CREATE TABLE `purchasebill` (
  `invoiceno` varchar(50) NOT NULL,
  `vendorname` varchar(100) NOT NULL,
  `itempurchase` varchar(200) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `qty` varchar(30) DEFAULT NULL,
  `bags` varchar(20) DEFAULT NULL,
  `price` varchar(30) NOT NULL,
  `totalamt` varchar(10) DEFAULT NULL,
  `amtpaid` varchar(10) DEFAULT NULL,
  `baldueamt` varchar(10) DEFAULT NULL,
  `updateddate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `vid` int(20) NOT NULL,
  `pricekg` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE settings;

CREATE TABLE `settings` (
  `id` int(2) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(350) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `recordProducts` int(10) NOT NULL,
  `recordCategories` int(10) NOT NULL,
  `recordRetail` int(10) NOT NULL,
  `recordCounSale` int(10) NOT NULL,
  `recordCreditGiven` int(10) NOT NULL,
  `recordPurchase` int(10) NOT NULL,
  `recordCustomer` int(10) NOT NULL,
  `recordInvQty` int(10) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO settings VALUES("1","Company","Peelamedu","0422-2625026","10","10","10","10","10","10","10","200");



DROP TABLE transaction;

CREATE TABLE `transaction` (
  `invoiceno` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `grosstotal` varchar(10) NOT NULL,
  `cash` varchar(10) NOT NULL,
  `credit` varchar(10) NOT NULL,
  `saletype` varchar(30) DEFAULT NULL,
  `trans_date` date NOT NULL DEFAULT current_timestamp(),
  `cflag` int(4) NOT NULL,
  `cusid` varchar(30) NOT NULL,
  `date` varchar(20) NOT NULL,
  `discount` varchar(20) NOT NULL,
  `nettotal` int(20) NOT NULL,
  `advamt` varchar(20) NOT NULL,
  `advdeducted` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE transactpurchase;

CREATE TABLE `transactpurchase` (
  `invoiceno` varchar(30) NOT NULL,
  `vendorname` varchar(100) NOT NULL,
  `totalamt` int(20) NOT NULL,
  `amtpaid` int(20) NOT NULL,
  `baldueamt` int(20) NOT NULL,
  `date` varchar(30) NOT NULL,
  `trans_date` date NOT NULL DEFAULT current_timestamp(),
  `cflag` int(4) NOT NULL,
  `vid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE vendor;

CREATE TABLE `vendor` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `place` varchar(200) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `totalamtpurchased` varchar(10) DEFAULT NULL,
  `totalamtdue` varchar(10) DEFAULT NULL,
  `lasttransactiondate` varchar(10) DEFAULT NULL,
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




