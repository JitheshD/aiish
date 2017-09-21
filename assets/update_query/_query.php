<?php
$sp = "

CREATE PROCEDURE `{$db_name}`.`toDoStockin`(
    IN stockinid int,
    IN hostelid int,
    IN assetid int,
    IN qnty varchar(20),
    IN totamt varchar(50),
    IN stockmonth varchar(10),
    IN stockmode varchar(10)
)
BEGIN
	BEGIN
	IF(stockinid = '') THEN
		INSERT INTO `stock_in_tb` (`stock_month`, `hostel_id`, `asset_id`, `quantity`, `total_amt`, `in_date`) VALUES (stockmonth, hostelid, assetid, qnty, totamt, NOW());
        
        UPDATE `av_stock_tb` SET `quantity` = `quantity`+qnty WHERE hostel_id = hostelid AND asset_id = assetid;
        
        IF(stockmode = 'INSERT') THEN
			SET @usageid = DATE_FORMAT(NOW(),'%d%m%Y-%k%i%s%f');
			INSERT INTO `monthly_usage_tb` (`usage_id`,`tran_month`,`hostel_id`,`asset_id`,`in_qty`) VALUES (@usageid, stockmonth, hostelid, assetid, qnty);
        ELSE
			UPDATE `monthly_usage_tb` SET `in_qty` = `in_qty`+qnty WHERE `tran_month` = stockmonth AND `hostel_id` = hostelid AND `asset_id` = assetid;
        END IF;
	ELSE
		UPDATE `stock_in_tb` SET `stock_month` = stockmonth, `hostel_id` = hostelid, `asset_id` = assetid, `quantity` = qnty, `total_amt` = totamt WHERE `stock_in_id` = stockinid;
	END IF;
END

";
mysql_query($sp);

if(mysql_errno()){
    $_SESSION["er"]=  mysql_error();
}