-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 28, 2014 at 12:59 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_tridev`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `added_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `added_by_type` int(11) NOT NULL,
  `modified_by_type` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '''1->ative'',''0->inactive''',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1->deleted;0->not deleted',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `sn` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(150) NOT NULL,
  `district` varchar(150) NOT NULL,
  `state` varchar(150) NOT NULL,
  `pin` varchar(10) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `client_type` varchar(50) NOT NULL,
  `cst_no` varchar(50) NOT NULL,
  `add_date` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `vat_reg_no` varchar(50) NOT NULL,
  `ecc_no` varchar(50) NOT NULL,
  `exice_reg_no` varchar(50) NOT NULL,
  `pan_no` varchar(50) NOT NULL,
  `service_tax_no` varchar(50) NOT NULL,
  `tan_no` varchar(50) NOT NULL,
  `ssi_no` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `added_by`, `modified_by`, `added_by_type`, `modified_by_type`, `status`, `is_deleted`, `created`, `modified`, `sn`, `name`, `code`, `address`, `street`, `city`, `district`, `state`, `pin`, `phone`, `mobile`, `client_type`, `cst_no`, `add_date`, `email`, `vat_reg_no`, `ecc_no`, `exice_reg_no`, `pan_no`, `service_tax_no`, `tan_no`, `ssi_no`) VALUES
(1, 1, 1, 1, 1, 1, 0, '2014-09-28 10:31:00', '2014-09-28 10:31:00', '9900', 'BetaClient', 'BETA34267', '@564', 'Max', 'Velenjua', 'Dmopa', 'Gofxta', '546546', '(432) 534-5345', '(456) 456-4564', 'Admin', '567567', '2014-09-12', 'beta@mail.com', '121321', '2132131', '21321321', '12313213', '213213213', '21321321', '32132132');

-- --------------------------------------------------------

--
-- Table structure for table `client_masters`
--

CREATE TABLE IF NOT EXISTS `client_masters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `material` varchar(200) NOT NULL,
  `quantity` int(10) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `added_date` date NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `added_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `added_by_type` int(11) NOT NULL,
  `modified_by_type` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '''1->ative'',''0->inactive''',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1->deleted;0->not deleted',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `client_masters`
--

INSERT INTO `client_masters` (`id`, `client_id`, `material`, `quantity`, `amount`, `added_date`, `invoice_no`, `added_by`, `modified_by`, `added_by_type`, `modified_by_type`, `status`, `is_deleted`, `created`, `modified`) VALUES
(1, 1, 'Surface Data', 12, '7896.00', '2014-09-24', '12345', 34, 34, 4, 4, 1, 0, '2014-09-28 10:52:34', '2014-09-28 10:52:34');

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

CREATE TABLE IF NOT EXISTS `cms_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(500) DEFAULT NULL,
  `sortorder` int(11) NOT NULL DEFAULT '0',
  `routepath` varchar(500) DEFAULT NULL,
  `slug` varchar(500) DEFAULT NULL,
  `view_status` int(11) DEFAULT '0',
  `is_active` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => Inactive; 1 => Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cms_pages`
--

INSERT INTO `cms_pages` (`id`, `title`, `content`, `meta_title`, `meta_description`, `meta_keywords`, `sortorder`, `routepath`, `slug`, `view_status`, `is_active`, `created`, `modified`) VALUES
(1, 'General Stock Terms', '<p class="MsoNormal"><a name="_GoBack"></a><b><span style="font-size:14.0pt">General Stock Terms</span></b><b><o:p></o:p></b></p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoNormal"><b><span style="font-size:14.0pt">Technical Analysis<o:p></o:p></span></b></p>\r\n<p class="MsoNormal">Technical analysis is simply the study of a stock price. It assumes that all the relevant market information about a stock is reflected in its price. Utilizing charts and indicators to identify price patterns and trends it is possible to get important clues as to when people are buying and selling. These clues help determine the probability of the future directional price movement of the stock and thus improve the odds that a trade will be successful.<b><o:p></o:p></b></p>\r\n<p class="MsoNormal"><b><span style="font-size:14.0pt">&nbsp;</span></b></p>\r\n<p class="MsoNormal"><b><span style="font-size:14.0pt">The Stock Trend<o:p></o:p></span></b></p>\r\n<p class="MsoNormal">A trend is simply the general direction in which a stock is moving over a specific period. Stock prices generally do not move in a straight line, but rather in a series of highs and lows. There are three types of trends: uptrend, downtrend and sideways trend. An uptrend forms from a series of higher highs and higher lows and a downtrend forms from lower highs and lower lows. The goal is to identify trend, the different stages of the trend, early/beginning, correction and late/ending, and then to make trades in the direction of the trend. For example, buy in the early stages of an uptrend and sell in the late stages where it may be ending or reversing.<o:p></o:p></p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoNormal">Side note: JIT Trading&rsquo;s trend analysis is short-term in nature. In general, up to 25 days is analyzed for short-term trading and up to 3 hours is analyzed for day trading.<o:p></o:p></p>\r\n<p class="MsoNormal"><b><span style="font-size:14.0pt">&nbsp;</span></b></p>\r\n<p class="MsoNormal"><b><span style="font-size:14.0pt">Support and Resistance<o:p></o:p></span></b></p>\r\n<p class="MsoNormal">Support is the price level at which a stock&rsquo;s price has stopped falling and is either moving sideways or has moved back up. Resistance, on the other hand, is the price level at which a stock&rsquo;s price has stopped rising and is either moving sideways or has moved back down. Support (demand) and resistance (supply) levels are the levels at which enough traders will step in to buy or sell that it prevents the price from either dropping or rising further.<o:p></o:p></p>\r\n<p class="MsoNormal">However, once a support or resistance level is broken, its role is reversed. If the price falls below a support level, then that level will become resistance. If the price rises above a resistance level, then that level will become a support level.<o:p></o:p></p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoNormal">Side note: JIT Trading calculates real-time trend lines to help identify support and resistance price levels and trend reversals to help identify when the two should be reversed.<o:p></o:p></p>\r\n<p class="MsoNormal"><b><span style="font-size:14.0pt">&nbsp;</span></b></p>\r\n<p class="MsoNormal"><b><span style="font-size:14.0pt">Technical Indicators in JIT Trading&rsquo;s Data Analysis </span><o:p></o:p></b></p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoNormal"><b><span style="font-size:14.0pt">The Stock Prices</span></b><o:p></o:p></p>\r\n<p class="MsoNormal">The stock prices posted in the summary tables are the prices at the time of download.&nbsp; The download prices vary from the actual prices for that specific time period due to the downloading time.<o:p></o:p></p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoNormal">For short-term trading, the stock prices are currently updated daily for as many as 150 stocks (more stocks will be added), in which, they include the four major indexes ETFs, S&amp;P 500 9 major sectors ETFs, the DOW 30 stocks and the NASDAQ 100 stocks. While for day trading, they are updated every 7.5 minute, sooner in a volatile session, for as many as 25 stocks (possibly more in the future).<o:p></o:p></p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoNormal">For day trading only, any stock&rsquo;s lower lows or higher highs&rsquo; prices occurred during the 15 minute interval are posted in the 7.5 minute time interval.<o:p></o:p></p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoNormal"><b><span style="font-size:14.0pt">The Stock Scores <o:p></o:p></span></b></p>\r\n<p class="MsoNormal">The stock tracking scores are computed using a number of technical indicators.&nbsp; When a stock&rsquo;s indicator has a positive reading, then it is given a score of +1. It is similarly given a 0 for a neutral reading and a -1 for a negative reading.&nbsp; The score is split if the indicator has more than one component. The total score is computed by adding the scores of all the indicators used for the stock.<o:p></o:p></p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoNormal">The scores range from -12 to 12. Positive scores are viewed as bullish while negative scores as bearish. The higher the positive score, the higher the stock is trading near the top of an uptrend, while the lower the negative score, the lower the stock is trading near the bottom of a downtrend.<o:p></o:p></p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoNormal">Stock scores generally give an accurate picture of a stock&rsquo;s current strength or weakness. However, since they are based on prices, as the prices change or fluctuate, the scores change as well. The stock scores are only an indication of what is likely to happen next, but never a guarantee. The current stock trend is likely to continue in the direction indicated by its score until the sign of the score changes.<o:p></o:p></p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoNormal">For day trading only, the stock&rsquo;s short-term scores should be consider as a primary trend while its day trade scores as a secondary one. In general, the odds for a successful trade are much improved when both are trending in the same general direction. In other words, when both scores are positive or both negative, rather than one positive and one negative.<o:p></o:p></p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoNormal"><b>Successfully trading stocks depends on finding opportunities</b>. The stock scores can be used to identify strong stocks versus weak stocks.<o:p></o:p></p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoNormal"><b><span style="font-size:14.0pt">P-PXO</span></b><b><o:p></o:p></b></p>\r\n<p class="MsoNormal">This very straightforward indicator is used to confirm a stock&rsquo;s RPI trend reversal signal (see RPI below), to determine whether the reversal is lasting or just temporary. P &ndash; PXO measures the difference between the current stock price and its previous stock price at the time of the RPI&rsquo;s reversal.<o:p></o:p></p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoNormal">For day trading, a stock&rsquo;s RPI reversal from the previous day''s session is not used in the current day''s session. The same is true with short-term trading: any crossovers occurring 24 days prior to the current session are not used.<o:p></o:p></p>\r\n<p class="MsoNormal">&nbsp;<o:p></o:p></p>\r\n<p class="MsoNormal"><b><span style="font-size:14.0pt">Relative Position Index (RPI)<o:p></o:p></span></b></p>\r\n<p class="MsoNormal">This<b> </b>is JIT Trading&rsquo;s own indicator and it is used to identify where within its current trend a stock is trading. RPI values are from the low 20s to the high 70s. An RPI greater than 50 generally means that a stock is considered on an uptrend and while less than 50 generally means it is considered on a downtrend.<o:p></o:p></p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoNormal">RPI values above 70 or below 30 generally indicate that a stock is trading near or at the top or bottom of the trend, respectively. Pullbacks are considered when the RPI&rsquo;s values fall from their highs and bounces are considered when the RPI&rsquo;s values rise from their lows.<o:p></o:p></p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoNormal">When a stock&rsquo;s RPI crosses over or under the 50 mark, it is a potential trend-reversal signal. A positive reversal is indicated when the RPI rises over 50 and a negative reversal when it drops under 50.<o:p></o:p></p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoNormal">The RPI is a lagging indicator usually following 1 or 2 intervals behind the stock&rsquo;s price, so it should be used in combination with the stock scores and the P-PXO indicators to filter and confirm its signals. This reduces the chance of getting a false trend-reversal signal. The RPI is in general less reliable when the stock is not trending but trading sideways or erratically.<o:p></o:p></p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoNormal">Generally, a positive reversal should follow by a rise in prices.&nbsp; The P-PXOs, thereafter, should have mostly positive gains. While, a negative reversal should follow by a decline in prices and the P-PXOs, thereafter, should have mostly negative losses. The exception is when there is already a big price change taken place at reversal or just prior to it, then some price correction that follows is not uncommon.<o:p></o:p></p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoNormal">There also will be time when the RPI''s values will move temporarily in the opposite direction as the stock prices. This is mainly due to how the data (or stock prices) being added to and removed from the list/set of data for the analysis, since only a fixed ''n'' number of data is used. At each update, the latest data (price) is added to the set while the earliest one is dropped from it and depending on how big a difference between the two, it could skew the RPI''s calculated values in one particular direction.<o:p></o:p></p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoNormal"><b>Successfully trading stocks depends on timing</b>. The RPI can be used to identify a stock&rsquo;s current trend (uptrend, downtrend or sideways), where it is within the trend (top, middle or bottom) and its expected trend change (continuation, correction or reversal). This information can help identify timely and favorable buy and sell points.<o:p></o:p></p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoNormal"><b><span style="font-size:14.0pt">P-PSR</span></b><b><o:p></o:p></b></p>\r\n<p class="MsoNormal">P &ndash; PSR measures the difference between a stock&rsquo;s current price and its price at either support or resistance levels. For P-PSR calculation, JIT Trading uses two different trend lines/levels each for support and resistance. The prices for support level 1 (S1) are higher than the prices for support level 2 (S2) and the prices for resistance level 1 (R1) are lower than the prices for resistance level 2 (R2).<o:p></o:p></p>\r\n<p class="MsoNormal">The calculations for P-PSR are as follows:<o:p></o:p></p>\r\n<p class="MsoNormal" style="text-indent:.5in">For stocks considered on an uptrend (when the RPI readings are 50 or greater):<o:p></o:p></p>\r\n<p class="MsoListParagraphCxSpFirst" style="margin-left:1.25in;mso-add-space:\r\nauto;text-indent:-.25in;mso-list:l0 level1 lfo1"><!--[if !supportLists]-->1)<span style="font-size: 7pt; font-family: ''Times New Roman'';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><!--[endif]-->When the current stock price is greater than or equal to S1, then the P-PSR value is the difference between the current stock price and S1. The positive values are displayed in green and right-aligned in the summary table.<o:p></o:p></p>\r\n<p class="MsoListParagraphCxSpMiddle" style="margin-left:1.25in;mso-add-space:\r\nauto;text-indent:-.25in;mso-list:l0 level1 lfo1"><!--[if !supportLists]-->2)<span style="font-size: 7pt; font-family: ''Times New Roman'';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><!--[endif]-->When the current stock price is less than S1, then the P-PSR value is the difference between the current stock price and S2. The positive values are displayed in green, while the negative ones (breakdowns from S2) are displayed in magenta and both are left-aligned in the summary table.<o:p></o:p></p>\r\n<p class="MsoListParagraphCxSpLast" style="margin-left:1.25in;mso-add-space:auto;\r\ntext-indent:-.25in;mso-list:l0 level1 lfo1"><!--[if !supportLists]-->3)<span style="font-size: 7pt; font-family: ''Times New Roman'';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><!--[endif]-->When the P-PSR values are between 0 and +0.02 (prices above, but near to S1, mainly for day trading), they are displayed in black.<o:p></o:p></p>\r\n<p class="MsoNormal" style="text-indent:.5in">For stocks considered on a downtrend (when the RPI readings are less than 50):<o:p></o:p></p>\r\n<p class="MsoListParagraphCxSpFirst" style="margin-left:1.25in;mso-add-space:\r\nauto;text-indent:-.25in;mso-list:l1 level1 lfo2"><!--[if !supportLists]-->1)<span style="font-size: 7pt; font-family: ''Times New Roman'';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><!--[endif]-->When the current stock price is lower than or equal to R1, then the P-PSR value is the difference between the current stock price and R1. The negative values are displayed in red and left-aligned in the summary table.<o:p></o:p></p>\r\n<p class="MsoListParagraphCxSpMiddle" style="margin-left:1.25in;mso-add-space:\r\nauto;text-indent:-.25in;mso-list:l1 level1 lfo2"><!--[if !supportLists]-->2)<span style="font-size: 7pt; font-family: ''Times New Roman'';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><!--[endif]-->When the current stock price is higher than R1, then the P-PSR value is the difference between the current stock price and R2. The negative values are displayed in red while the positive ones are displayed in cyan (breakouts from R2) and both are right-aligned in the summary table.<o:p></o:p></p>\r\n<p class="MsoListParagraphCxSpLast" style="margin-left:1.25in;mso-add-space:auto;\r\ntext-indent:-.25in;mso-list:l1 level1 lfo2"><!--[if !supportLists]-->3)<span style="font-size: 7pt; font-family: ''Times New Roman'';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><!--[endif]-->When the P-PSR values are between 0 and -0.02 (prices below but near R1), they are displayed in black.<o:p></o:p></p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoNormal"><b>Successfully trading stocks depends on having an edge</b>. P-PSR can be used to identify different levels of support and resistance and as to when the stock prices are trading above, near or below (and breakouts from) those levels.<o:p></o:p></p>', 'General Stock Terms', 'General Stock Terms', 'General Stock Terms', 0, NULL, NULL, 0, 1, '2014-08-25 01:37:21', '2014-08-24 20:24:26'),
(2, 'Terms and Conditions', '<p class="MsoNormal"><a name="_GoBack"></a>Terms and Conditions</p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoListParagraphCxSpFirst" style="margin-left:22.5pt;mso-add-space:\r\nauto;text-indent:-.25in;mso-list:l0 level1 lfo1"><!--[if !supportLists]-->1)<span style="font-size: 7pt; font-family: ''Times New Roman'';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><!--[endif]-->General</p>\r\n<p class="MsoListParagraphCxSpLast">This website, &ldquo;JITTradings.com&rdquo; is offered to you conditioned on your acceptance with all the terms and conditions set out in this Agreement. By accessing and using this website, you are deemed to have agreed to all such terms and conditions.</p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoListParagraphCxSpFirst" style="margin-left:22.5pt;mso-add-space:\r\nauto;text-indent:-.25in;mso-list:l0 level1 lfo1"><!--[if !supportLists]-->2)<span style="font-size: 7pt; font-family: ''Times New Roman'';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><!--[endif]-->Accuracy of Information</p>\r\n<p class="MsoListParagraphCxSpMiddle">While the information is believed to be reliable, none of the information on this website is guaranteed to be accurate, complete, adequate or timely. All the data and information are provided &ldquo;as is&rdquo; and &ldquo;as available&rdquo; without warranty of any kind, express or implied.</p>\r\n<p class="MsoListParagraphCxSpMiddle"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoListParagraphCxSpMiddle" style="margin-left:22.5pt;mso-add-space:\r\nauto;text-indent:-.25in;mso-list:l0 level1 lfo1"><!--[if !supportLists]-->3)<span style="font-size: 7pt; font-family: ''Times New Roman'';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><!--[endif]-->Restriction on Use of Data</p>\r\n<p class="MsoListParagraphCxSpMiddle">The data retrieved from &ldquo;JITTradings.com&rdquo; website may only be used for personal purpose. You may not copy, distribute or redistribute the data. You may not sell, resell, retransmit or otherwise make the data available in any manner to any third party.</p>\r\n<p class="MsoListParagraphCxSpMiddle"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoListParagraphCxSpMiddle" style="margin-left:22.5pt;mso-add-space:\r\nauto;text-indent:-.25in;mso-list:l0 level1 lfo1"><!--[if !supportLists]-->4)<span style="font-size: 7pt; font-family: ''Times New Roman'';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><!--[endif]-->Liability</p>\r\n<p class="MsoListParagraphCxSpMiddle">Under no circumstances, shall &ldquo;JITTradings.com&rdquo; be liable for any direct, indirect, incidental, punitive, special or consequential damages that result from the use of any materials available on this website, even if &ldquo;JITTradings.com&rdquo;, has been advised of such damages.</p>\r\n<p class="MsoListParagraphCxSpMiddle"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoListParagraphCxSpMiddle">Data transmission may be subject to arbitrary delays beyond &ldquo;JITTradings.com&rdquo; control, which may delay the provision of services. You acknowledge that &ldquo;JITTradings.com&rdquo; will not be liable for any losses arising from such delay. In no event, &ldquo;JITTradings.com&rdquo; will be liable for any consequential loss including but not limited to direct, indirect, incidental, punitive, special or consequential damages resulting from delay or loss of use of services.</p>\r\n<p class="MsoListParagraphCxSpMiddle"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoListParagraphCxSpMiddle">&nbsp;If you are dissatisfied with any &ldquo;JITTradings.com&rdquo; data or information or with any of the terms and conditions contained or offered in this website, it is your sole responsibility to discontinue using &ldquo;JITTradings.com.&rdquo;</p>\r\n<p class="MsoListParagraphCxSpMiddle"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoListParagraphCxSpMiddle" style="margin-left:22.5pt;mso-add-space:\r\nauto;text-indent:-.25in;mso-list:l0 level1 lfo1"><!--[if !supportLists]-->5)<span style="font-size: 7pt; font-family: ''Times New Roman'';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><!--[endif]-->Modification of Terms and Conditions</p>\r\n<p class="MsoListParagraphCxSpLast">&ldquo;JITTradings.com&rdquo; reserves the right to change or modify this Terms and Conditions Agreement at any time, with or without notice. Such changes or modifications shall be made effective for all visitors and subscribers upon posting of the modified Agreement to this website. You are responsible for regularly reviewing these terms and conditions to ensure that your use of the service remains in compliance with this Agreement</p>\r\n<p style="margin-left:22.5pt;text-indent:-.25in;mso-list:l1 level1 lfo2"><!--[if !supportLists]-->6)<span style="font-size: 7pt; font-family: ''Times New Roman'';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><!--[endif]-->Disclaimer</p>\r\n<p style="margin-left:.5in">Trading stocks involves risks, and there is always potential of losing money. Past performance of a stock does not guarantee future results or success. Be informed and fully understand all risks associated with stock markets and trading.</p>\r\n<p style="margin-left:.5in">None of the information provided should be considered a recommendation or solicitation to trade a particular stock or ETFs or an endorsement or affirmation of any specific trading strategy. Traders are entirely responsible for their trading decisions. &ldquo;JITTradings.com&rdquo; will not offer or provide any advice, opinion or recommendation on any particular trading strategy</p>', 'Terms and Conditions', 'Terms and Conditions', 'Terms and Conditions', 0, NULL, NULL, 0, 1, '2014-08-25 01:38:49', '2014-08-24 20:28:16'),
(3, 'HPage Text', '<p class="MsoNormal"><a name="_GoBack"></a>JIT Trading provides real-time data analysis of stock prices for short-term and day traders. With JIT Trading&rsquo;s own technical indicators like the Stock Scores, the Relative Position Index (RPI) and its two supporting indicators, P-PXO and P-PSR, the traders basically will have all the important data needed to identify stocks&rsquo; trends, track stocks&rsquo; movements, spot stocks&rsquo; corrections and reversals and find potential trading opportunities.</p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoNormal">Displayed in Microsoft Excel spreadsheets, the data can be quickly scanned and easily tracked. For short-term trading, the data are provided for 150 stocks and ETFs and they are updated daily. While for day trading, the data are provided for 25 stocks and ETFs and they are updated every 7&frac12; minute from 6:30 AM to 1:00 PM. [side note: for visitors to the site, the day trading data can be viewed daily on the website after the market closes]</p>\r\n<p class="MsoNormal"><o:p>&nbsp;</o:p></p>\r\n<p class="MsoNormal">Knowledge is power and where opportunity lies. With JIT Trading&rsquo;s unique data offerings, the traders can be better informed, gain real insights and obtain must-have information on stocks. What a better way to gain an edge in trading!</p>', NULL, 'HPage Text', 'HPage Text', 0, NULL, NULL, 0, 1, '2014-08-25 01:40:20', '2014-08-24 20:28:55');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `iso` char(2) NOT NULL DEFAULT '',
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `iso_2` (`iso`),
  KEY `iso` (`iso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=240 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `iso`, `iso3`, `numcode`) VALUES
(1, 'AFGHANISTAN', 'AF', 'AFG', 4),
(2, 'ALBANIA', 'AL', 'ALB', 8),
(3, 'ALGERIA', 'DZ', 'DZA', 12),
(4, 'AMERICAN SAMOA', 'AS', 'ASM', 16),
(5, 'ANDORRA', 'AD', 'AND', 20),
(6, 'ANGOLA', 'AO', 'AGO', 24),
(7, 'ANGUILLA', 'AI', 'AIA', 660),
(8, 'ANTARCTICA', 'AQ', NULL, NULL),
(9, 'ANTIGUA AND BARBUDA', 'AG', 'ATG', 28),
(10, 'ARGENTINA', 'AR', 'ARG', 32),
(11, 'ARMENIA', 'AM', 'ARM', 51),
(12, 'ARUBA', 'AW', 'ABW', 533),
(13, 'AUSTRALIA', 'AU', 'AUS', 36),
(14, 'AUSTRIA', 'AT', 'AUT', 40),
(15, 'AZERBAIJAN', 'AZ', 'AZE', 31),
(16, 'BAHAMAS', 'BS', 'BHS', 44),
(17, 'BAHRAIN', 'BH', 'BHR', 48),
(18, 'BANGLADESH', 'BD', 'BGD', 50),
(19, 'BARBADOS', 'BB', 'BRB', 52),
(20, 'BELARUS', 'BY', 'BLR', 112),
(21, 'BELGIUM', 'BE', 'BEL', 56),
(22, 'BELIZE', 'BZ', 'BLZ', 84),
(23, 'BENIN', 'BJ', 'BEN', 204),
(24, 'BERMUDA', 'BM', 'BMU', 60),
(25, 'BHUTAN', 'BT', 'BTN', 64),
(26, 'BOLIVIA', 'BO', 'BOL', 68),
(27, 'BOSNIA AND HERZEGOVINA', 'BA', 'BIH', 70),
(28, 'BOTSWANA', 'BW', 'BWA', 72),
(29, 'BOUVET ISLAND', 'BV', NULL, NULL),
(30, 'BRAZIL', 'BR', 'BRA', 76),
(31, 'BRITISH INDIAN OCEAN TERRITORY', 'IO', NULL, NULL),
(32, 'BRUNEI DARUSSALAM', 'BN', 'BRN', 96),
(33, 'BULGARIA', 'BG', 'BGR', 100),
(34, 'BURKINA FASO', 'BF', 'BFA', 854),
(35, 'BURUNDI', 'BI', 'BDI', 108),
(36, 'CAMBODIA', 'KH', 'KHM', 116),
(37, 'CAMEROON', 'CM', 'CMR', 120),
(38, 'CANADA', 'CA', 'CAN', 124),
(39, 'CAPE VERDE', 'CV', 'CPV', 132),
(40, 'CAYMAN ISLANDS', 'KY', 'CYM', 136),
(41, 'CENTRAL AFRICAN REPUBLIC', 'CF', 'CAF', 140),
(42, 'CHAD', 'TD', 'TCD', 148),
(43, 'CHILE', 'CL', 'CHL', 152),
(44, 'CHINA', 'CN', 'CHN', 156),
(45, 'CHRISTMAS ISLAND', 'CX', NULL, NULL),
(46, 'COCOS (KEELING) ISLANDS', 'CC', NULL, NULL),
(47, 'COLOMBIA', 'CO', 'COL', 170),
(48, 'COMOROS', 'KM', 'COM', 174),
(49, 'CONGO', 'CG', 'COG', 178),
(50, 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'CD', 'COD', 180),
(51, 'COOK ISLANDS', 'CK', 'COK', 184),
(52, 'COSTA RICA', 'CR', 'CRI', 188),
(53, 'COTE D''IVOIRE', 'CI', 'CIV', 384),
(54, 'CROATIA', 'HR', 'HRV', 191),
(55, 'CUBA', 'CU', 'CUB', 192),
(56, 'CYPRUS', 'CY', 'CYP', 196),
(57, 'CZECH REPUBLIC', 'CZ', 'CZE', 203),
(58, 'DENMARK', 'DK', 'DNK', 208),
(59, 'DJIBOUTI', 'DJ', 'DJI', 262),
(60, 'DOMINICA', 'DM', 'DMA', 212),
(61, 'DOMINICAN REPUBLIC', 'DO', 'DOM', 214),
(62, 'ECUADOR', 'EC', 'ECU', 218),
(63, 'EGYPT', 'EG', 'EGY', 818),
(64, 'EL SALVADOR', 'SV', 'SLV', 222),
(65, 'EQUATORIAL GUINEA', 'GQ', 'GNQ', 226),
(66, 'ERITREA', 'ER', 'ERI', 232),
(67, 'ESTONIA', 'EE', 'EST', 233),
(68, 'ETHIOPIA', 'ET', 'ETH', 231),
(69, 'FALKLAND ISLANDS (MALVINAS)', 'FK', 'FLK', 238),
(70, 'FAROE ISLANDS', 'FO', 'FRO', 234),
(71, 'FIJI', 'FJ', 'FJI', 242),
(72, 'FINLAND', 'FI', 'FIN', 246),
(73, 'FRANCE', 'FR', 'FRA', 250),
(74, 'FRENCH GUIANA', 'GF', 'GUF', 254),
(75, 'FRENCH POLYNESIA', 'PF', 'PYF', 258),
(76, 'FRENCH SOUTHERN TERRITORIES', 'TF', NULL, NULL),
(77, 'GABON', 'GA', 'GAB', 266),
(78, 'GAMBIA', 'GM', 'GMB', 270),
(79, 'GEORGIA', 'GE', 'GEO', 268),
(80, 'GERMANY', 'DE', 'DEU', 276),
(81, 'GHANA', 'GH', 'GHA', 288),
(82, 'GIBRALTAR', 'GI', 'GIB', 292),
(83, 'GREECE', 'GR', 'GRC', 300),
(84, 'GREENLAND', 'GL', 'GRL', 304),
(85, 'GRENADA', 'GD', 'GRD', 308),
(86, 'GUADELOUPE', 'GP', 'GLP', 312),
(87, 'GUAM', 'GU', 'GUM', 316),
(88, 'GUATEMALA', 'GT', 'GTM', 320),
(89, 'GUINEA', 'GN', 'GIN', 324),
(90, 'GUINEA-BISSAU', 'GW', 'GNB', 624),
(91, 'GUYANA', 'GY', 'GUY', 328),
(92, 'HAITI', 'HT', 'HTI', 332),
(93, 'HEARD ISLAND AND MCDONALD ISLANDS', 'HM', NULL, NULL),
(94, 'HOLY SEE (VATICAN CITY STATE)', 'VA', 'VAT', 336),
(95, 'HONDURAS', 'HN', 'HND', 340),
(96, 'HONG KONG', 'HK', 'HKG', 344),
(97, 'HUNGARY', 'HU', 'HUN', 348),
(98, 'ICELAND', 'IS', 'ISL', 352),
(99, 'INDIA', 'IN', 'IND', 356),
(100, 'INDONESIA', 'ID', 'IDN', 360),
(101, 'IRAN, ISLAMIC REPUBLIC OF', 'IR', 'IRN', 364),
(102, 'IRAQ', 'IQ', 'IRQ', 368),
(103, 'IRELAND', 'IE', 'IRL', 372),
(104, 'ISRAEL', 'IL', 'ISR', 376),
(105, 'ITALY', 'IT', 'ITA', 380),
(106, 'JAMAICA', 'JM', 'JAM', 388),
(107, 'JAPAN', 'JP', 'JPN', 392),
(108, 'JORDAN', 'JO', 'JOR', 400),
(109, 'KAZAKHSTAN', 'KZ', 'KAZ', 398),
(110, 'KENYA', 'KE', 'KEN', 404),
(111, 'KIRIBATI', 'KI', 'KIR', 296),
(112, 'KOREA, DEMOCRATIC PEOPLE''S REPUBLIC OF', 'KP', 'PRK', 408),
(113, 'KOREA, REPUBLIC OF', 'KR', 'KOR', 410),
(114, 'KUWAIT', 'KW', 'KWT', 414),
(115, 'KYRGYZSTAN', 'KG', 'KGZ', 417),
(116, 'LAO PEOPLE''S DEMOCRATIC REPUBLIC', 'LA', 'LAO', 418),
(117, 'LATVIA', 'LV', 'LVA', 428),
(118, 'LEBANON', 'LB', 'LBN', 422),
(119, 'LESOTHO', 'LS', 'LSO', 426),
(120, 'LIBERIA', 'LR', 'LBR', 430),
(121, 'LIBYAN ARAB JAMAHIRIYA', 'LY', 'LBY', 434),
(122, 'LIECHTENSTEIN', 'LI', 'LIE', 438),
(123, 'LITHUANIA', 'LT', 'LTU', 440),
(124, 'LUXEMBOURG', 'LU', 'LUX', 442),
(125, 'MACAO', 'MO', 'MAC', 446),
(126, 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'MK', 'MKD', 807),
(127, 'MADAGASCAR', 'MG', 'MDG', 450),
(128, 'MALAWI', 'MW', 'MWI', 454),
(129, 'MALAYSIA', 'MY', 'MYS', 458),
(130, 'MALDIVES', 'MV', 'MDV', 462),
(131, 'MALI', 'ML', 'MLI', 466),
(132, 'MALTA', 'MT', 'MLT', 470),
(133, 'MARSHALL ISLANDS', 'MH', 'MHL', 584),
(134, 'MARTINIQUE', 'MQ', 'MTQ', 474),
(135, 'MAURITANIA', 'MR', 'MRT', 478),
(136, 'MAURITIUS', 'MU', 'MUS', 480),
(137, 'MAYOTTE', 'YT', NULL, NULL),
(138, 'MEXICO', 'MX', 'MEX', 484),
(139, 'MICRONESIA, FEDERATED STATES OF', 'FM', 'FSM', 583),
(140, 'MOLDOVA, REPUBLIC OF', 'MD', 'MDA', 498),
(141, 'MONACO', 'MC', 'MCO', 492),
(142, 'MONGOLIA', 'MN', 'MNG', 496),
(143, 'MONTSERRAT', 'MS', 'MSR', 500),
(144, 'MOROCCO', 'MA', 'MAR', 504),
(145, 'MOZAMBIQUE', 'MZ', 'MOZ', 508),
(146, 'MYANMAR', 'MM', 'MMR', 104),
(147, 'NAMIBIA', 'NA', 'NAM', 516),
(148, 'NAURU', 'NR', 'NRU', 520),
(149, 'NEPAL', 'NP', 'NPL', 524),
(150, 'NETHERLANDS', 'NL', 'NLD', 528),
(151, 'NETHERLANDS ANTILLES', 'AN', 'ANT', 530),
(152, 'NEW CALEDONIA', 'NC', 'NCL', 540),
(153, 'NEW ZEALAND', 'NZ', 'NZL', 554),
(154, 'NICARAGUA', 'NI', 'NIC', 558),
(155, 'NIGER', 'NE', 'NER', 562),
(156, 'NIGERIA', 'NG', 'NGA', 566),
(157, 'NIUE', 'NU', 'NIU', 570),
(158, 'NORFOLK ISLAND', 'NF', 'NFK', 574),
(159, 'NORTHERN MARIANA ISLANDS', 'MP', 'MNP', 580),
(160, 'NORWAY', 'NO', 'NOR', 578),
(161, 'OMAN', 'OM', 'OMN', 512),
(162, 'PAKISTAN', 'PK', 'PAK', 586),
(163, 'PALAU', 'PW', 'PLW', 585),
(164, 'PALESTINIAN TERRITORY, OCCUPIED', 'PS', NULL, NULL),
(165, 'PANAMA', 'PA', 'PAN', 591),
(166, 'PAPUA NEW GUINEA', 'PG', 'PNG', 598),
(167, 'PARAGUAY', 'PY', 'PRY', 600),
(168, 'PERU', 'PE', 'PER', 604),
(169, 'PHILIPPINES', 'PH', 'PHL', 608),
(170, 'PITCAIRN', 'PN', 'PCN', 612),
(171, 'POLAND', 'PL', 'POL', 616),
(172, 'PORTUGAL', 'PT', 'PRT', 620),
(173, 'PUERTO RICO', 'PR', 'PRI', 630),
(174, 'QATAR', 'QA', 'QAT', 634),
(175, 'REUNION', 'RE', 'REU', 638),
(176, 'ROMANIA', 'RO', 'ROM', 642),
(177, 'RUSSIAN FEDERATION', 'RU', 'RUS', 643),
(178, 'RWANDA', 'RW', 'RWA', 646),
(179, 'SAINT HELENA', 'SH', 'SHN', 654),
(180, 'SAINT KITTS AND NEVIS', 'KN', 'KNA', 659),
(181, 'SAINT LUCIA', 'LC', 'LCA', 662),
(182, 'SAINT PIERRE AND MIQUELON', 'PM', 'SPM', 666),
(183, 'SAINT VINCENT AND THE GRENADINES', 'VC', 'VCT', 670),
(184, 'SAMOA', 'WS', 'WSM', 882),
(185, 'SAN MARINO', 'SM', 'SMR', 674),
(186, 'SAO TOME AND PRINCIPE', 'ST', 'STP', 678),
(187, 'SAUDI ARABIA', 'SA', 'SAU', 682),
(188, 'SENEGAL', 'SN', 'SEN', 686),
(189, 'SEYCHELLES', 'SC', 'SYC', 690),
(190, 'SIERRA LEONE', 'SL', 'SLE', 694),
(191, 'SINGAPORE', 'SG', 'SGP', 702),
(192, 'SLOVAKIA', 'SK', 'SVK', 703),
(193, 'SLOVENIA', 'SI', 'SVN', 705),
(194, 'SOLOMON ISLANDS', 'SB', 'SLB', 90),
(195, 'SOMALIA', 'SO', 'SOM', 706),
(196, 'SOUTH AFRICA', 'ZA', 'ZAF', 710),
(197, 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'GS', NULL, NULL),
(198, 'SPAIN', 'ES', 'ESP', 724),
(199, 'SRI LANKA', 'LK', 'LKA', 144),
(200, 'SUDAN', 'SD', 'SDN', 736),
(201, 'SURINAME', 'SR', 'SUR', 740),
(202, 'SVALBARD AND JAN MAYEN', 'SJ', 'SJM', 744),
(203, 'SWAZILAND', 'SZ', 'SWZ', 748),
(204, 'SWEDEN', 'SE', 'SWE', 752),
(205, 'SWITZERLAND', 'CH', 'CHE', 756),
(206, 'SYRIAN ARAB REPUBLIC', 'SY', 'SYR', 760),
(207, 'TAIWAN, PROVINCE OF CHINA', 'TW', 'TWN', 158),
(208, 'TAJIKISTAN', 'TJ', 'TJK', 762),
(209, 'TANZANIA, UNITED REPUBLIC OF', 'TZ', 'TZA', 834),
(210, 'THAILAND', 'TH', 'THA', 764),
(211, 'TIMOR-LESTE', 'TL', NULL, NULL),
(212, 'TOGO', 'TG', 'TGO', 768),
(213, 'TOKELAU', 'TK', 'TKL', 772),
(214, 'TONGA', 'TO', 'TON', 776),
(215, 'TRINIDAD AND TOBAGO', 'TT', 'TTO', 780),
(216, 'TUNISIA', 'TN', 'TUN', 788),
(217, 'TURKEY', 'TR', 'TUR', 792),
(218, 'TURKMENISTAN', 'TM', 'TKM', 795),
(219, 'TURKS AND CAICOS ISLANDS', 'TC', 'TCA', 796),
(220, 'TUVALU', 'TV', 'TUV', 798),
(221, 'UGANDA', 'UG', 'UGA', 800),
(222, 'UKRAINE', 'UA', 'UKR', 804),
(223, 'UNITED ARAB EMIRATES', 'AE', 'ARE', 784),
(224, 'UNITED KINGDOM', 'GB', 'GBR', 826),
(225, 'UNITED STATES', 'US', 'USA', 840),
(226, 'UNITED STATES MINOR OUTLYING ISLANDS', 'UM', NULL, NULL),
(227, 'URUGUAY', 'UY', 'URY', 858),
(228, 'UZBEKISTAN', 'UZ', 'UZB', 860),
(229, 'VANUATU', 'VU', 'VUT', 548),
(230, 'VENEZUELA', 'VE', 'VEN', 862),
(231, 'VIET NAM', 'VN', 'VNM', 704),
(232, 'VIRGIN ISLANDS, BRITISH', 'VG', 'VGB', 92),
(233, 'VIRGIN ISLANDS, U.S.', 'VI', 'VIR', 850),
(234, 'WALLIS AND FUTUNA', 'WF', 'WLF', 876),
(235, 'WESTERN SAHARA', 'EH', 'ESH', 732),
(236, 'YEMEN', 'YE', 'YEM', 887),
(237, 'YUGOSLAVIA', 'YU', 'YUG', 891),
(238, 'ZAMBIA', 'ZM', 'ZMB', 894),
(239, 'ZIMBABWE', 'ZW', 'ZWE', 716);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `service_type` enum('d','s') NOT NULL DEFAULT 'd' COMMENT 'd=>Day Trading or s=>Short-Term Trading',
  `username` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `security_question` varchar(255) NOT NULL,
  `security_answer` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(4) NOT NULL,
  `state` varchar(4) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `machine_info` varchar(255) NOT NULL,
  `client_ip` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '''1''=>Active, ''0''=>In active',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '''1''=>Deleted, ''0''=>Not Deleted',
  `payment_status` varchar(30) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `unique_key` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `service_type`, `username`, `password`, `security_question`, `security_answer`, `first_name`, `last_name`, `email`, `address1`, `address2`, `city`, `country`, `state`, `zip`, `phone`, `machine_info`, `client_ip`, `last_login`, `status`, `is_deleted`, `payment_status`, `amount`, `unique_key`, `created`, `modified`) VALUES
(1, 'd', 'rahulda', 'e3ceb5881a0a1fdaad01296d7554868d', 'what is your pet name?a', 'testa', 'Rahulda', 'Dhimanda', 'rahuldda@gmail.com', '#123a', '#567a', 'moza', 'US', 'AK', '12121', '444444444411', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:27.0) Gecko/20100101 Firefox/27.0', '127.0.0.1', '0000-00-00 00:00:00', 1, 0, NULL, '149.00', '300814074907rahuld', '2014-08-30 19:49:07', '2014-08-31 10:55:00'),
(2, 'd', 'rahuldx', '9db06bcff9248837f86d1a6bcf41c9e7', 'what is your pet name?', 'dfgdfxgdfg', 'Rohan', 'Dhiman', 'rahuldss@gmail.com', '#123', '#567', 'moz', 'US', 'AK', '1212', '4444444444', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:27.0) Gecko/20100101 Firefox/27.0', '127.0.0.1', '0000-00-00 00:00:00', 1, 0, NULL, '149.00', '300814074907rahuld', '2014-08-30 19:49:07', '2014-08-30 19:49:07');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `template_for` varchar(255) NOT NULL,
  `mail_subject` varchar(255) NOT NULL,
  `mail_body` longtext NOT NULL,
  `is_active` tinyint(4) unsigned NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `template_for`, `mail_subject`, `mail_body`, `is_active`, `created`, `modified`) VALUES
(1, 'Reset Password', 'Your New Password for JitTraders', '<table cellspacing="0" cellpadding="0" border="0" align="center" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; width: 650px;">\r\n    <thead>\r\n        <tr>\r\n            <td>\r\n            <table cellspacing="0" cellpadding="0" border="0" style="" width="100%">\r\n                <tbody>\r\n                    <tr>\r\n                        <td align="left" style="padding: 10px; background: rgb(40, 176, 42);">\r\n                        <p style=""><span style="color: rgb(255, 255, 255); font-size: xx-large;"><a href="http://riversonata.com/demo"><img src="http://riversonata.com/demo/app/webroot/img/logo.png" width="140" height="71" align="absMiddle" alt="JitTraders" vspace="1" hspace="8" /></a>JitTraders&nbsp;</span><span style="color: rgb(255, 255, 255); font-size: large;">T</span><font color="#ffffff" size="4">rade with an Edge</font></p>\r\n                        </td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            </td>\r\n        </tr>\r\n    </thead>\r\n    <tbody>\r\n        <tr>\r\n            <td>\r\n            <table cellspacing="0" cellpadding="0" border="0" style="background: none repeat scroll 0% 0% #f8f8f8; width: 100%;">\r\n                <tbody>\r\n                    <tr>\r\n                        <td height="50">&nbsp;</td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td>\r\n                        <table cellspacing="0" cellpadding="0" border="0" align="center" style="border-width: 9px 1px 1px; border-style: solid; border-color: #28B02A #ededed #ededed; background: none repeat scroll 0% 0% #ffffff; width: 96%;">\r\n                            <tbody>\r\n                                <tr>\r\n                                    <td style="padding: 12px 16px;">\r\n                                    <p>Dear&nbsp;<span style="font-size: 13px;">#FIRSTNAME</span>,</p>\r\n                                    <p><span style="font-family: Tahoma;"><font size="2">Your New password detail is as below .</font><span style="font-size: small;"> </span><span style="font-size: small;">Good luck!</span></span></p>\r\n                                    <p><span style="font-family: Tahoma;"><u><b><span style="font-size: small;">Here are your login details:</span></b></u></span></p>\r\n                                    <table cellspacing="0" cellpadding="0" border="1" style="border: 1px solid #cccccc; border-collapse: collapse; width: 100%;">\r\n                                        <tbody>\r\n                                            <tr>\r\n                                                <td width="20%" style="background: #f4f4f4; padding: 8px; border: 1px solid #ccc;">Login URL:</td>\r\n                                                <td style="background: #fff; padding: 8px; border: 1px solid #ccc;"><span style="font-size: small;">#CLICKHERE</span></td>\r\n                                            </tr>\r\n                                            <tr>\r\n                                                <td width="20%" style="background: #f4f4f4; border: 1px solid #ccc; padding: 8px;">UserName:</td>\r\n                                                <td style="background: #fff; padding: 8px; border: 1px solid #ccc;">#USERNAME</td>\r\n                                            </tr>\r\n                                            <tr>\r\n                                                <td width="20%" style="background: #f4f4f4; border: 1px solid #ccc; padding: 8px;">New Password:</td>\r\n                                                <td style="background: #fff; border: 1px solid #ccc; padding: 8px;">#PASSWORD</td>\r\n                                            </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                    </td>\r\n                                </tr>\r\n                            </tbody>\r\n                        </table>\r\n                        </td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td height="50">\r\n                        <p>&nbsp;</p>\r\n                        <p>Thanks,</p>\r\n                        <p>The JitTraders Support Team</p>\r\n                        <p>&nbsp;</p>\r\n                        </td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n    <tfoot>\r\n    <tr>\r\n        <td style="background: #28B02A; padding: 10px;font-size:15px;color:#FFFFFF">jittraders.com</td>\r\n    </tr>\r\n    </tfoot>\r\n</table>', 1, '2014-04-15 00:00:00', '2014-08-24 13:37:09'),
(2, 'When create new administrator', 'Your account detail to access JitTraders', '<table cellspacing="0" cellpadding="0" border="0" align="center" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; width: 650px;">\r\n    <thead>\r\n        <tr>\r\n            <td>\r\n            <table cellspacing="0" cellpadding="0" border="0" style="" width="100%">\r\n                <tbody>\r\n                    <tr>\r\n                        <td align="left" style="padding: 10px; background: rgb(40, 176, 42);">\r\n                        <p style=""><span style="color: rgb(255, 255, 255); font-size: xx-large;"><a href="http://riversonata.com/demo"><img src="http://riversonata.com/demo/app/webroot/img/logo.png" width="140" height="71" align="absMiddle" alt="JitTraders" vspace="1" hspace="8" /></a>JitTraders&nbsp;</span><span style="color: rgb(255, 255, 255); font-size: large;">T</span><font color="#ffffff" size="4">rade with an Edge</font></p>\r\n                        </td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            </td>\r\n        </tr>\r\n    </thead>\r\n    <tbody>\r\n        <tr>\r\n            <td>\r\n            <table cellspacing="0" cellpadding="0" border="0" style="background: none repeat scroll 0% 0% #f8f8f8; width: 100%;">\r\n                <tbody>\r\n                    <tr>\r\n                        <td height="50">&nbsp;</td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td>\r\n                        <table cellspacing="0" cellpadding="0" border="0" align="center" style="border-width: 9px 1px 1px; border-style: solid; border-color: #28B02A #ededed #ededed; background: none repeat scroll 0% 0% #ffffff; width: 96%;">\r\n                            <tbody>\r\n                                <tr>\r\n                                    <td style="padding: 12px 16px;">\r\n                                    <p>Dear&nbsp;<span style="font-size: 13px;">#FIRSTNAME</span>,</p>\r\n                                    <p><span style="font-family: Tahoma;"><span style="font-size: small;">JitTraders would like to welcome you to our Stock Trading Website! You may now Login to your new Account Dashboard. </span><span style="font-size: small;">Good luck!</span></span></p>\r\n                                    <p><span style="font-family: Tahoma;"><u><b><span style="font-size: small;">Here are your login details:</span></b></u></span></p>\r\n                                    <table cellspacing="0" cellpadding="0" border="1" style="border: 1px solid #cccccc; border-collapse: collapse; width: 100%;">\r\n                                        <tbody>\r\n                                            <tr>\r\n                                                <td width="20%" style="background: #f4f4f4; padding: 8px; border: 1px solid #ccc;">Login URL:</td>\r\n                                                <td style="background: #fff; padding: 8px; border: 1px solid #ccc;"><span style="font-size: small;">#CLICKHERE</span></td>\r\n                                            </tr>\r\n                                            <tr>\r\n                                                <td width="20%" style="background: #f4f4f4; border: 1px solid #ccc; padding: 8px;">UserName:</td>\r\n                                                <td style="background: #fff; padding: 8px; border: 1px solid #ccc;">#USERNAME</td>\r\n                                            </tr>\r\n                                            <tr>\r\n                                                <td width="20%" style="background: #f4f4f4; border: 1px solid #ccc; padding: 8px;">Password:</td>\r\n                                                <td style="background: #fff; border: 1px solid #ccc; padding: 8px;">#PASSWORD</td>\r\n                                            </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                    </td>\r\n                                </tr>\r\n                            </tbody>\r\n                        </table>\r\n                        </td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td height="50">\r\n                        <p>&nbsp;</p>\r\n                        <p>Thanks,</p>\r\n                        <p>The JitTraders Support Team</p>\r\n                        <p>&nbsp;</p>\r\n                        </td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n    <tfoot>\r\n    <tr>\r\n        <td style="background: #28B02A; padding: 10px;font-size:15px;color:#FFFFFF">jittraders.com</td>\r\n    </tr>\r\n    </tfoot>\r\n</table>', 1, '2014-04-15 00:00:00', '2014-08-24 13:38:25');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `code` char(2) NOT NULL DEFAULT '',
  `state_prov` text NOT NULL,
  `country` char(2) NOT NULL DEFAULT 'US',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `code`, `state_prov`, `country`) VALUES
(1, 'AL', 'Alabama', 'US'),
(2, 'AK', 'Alaska', 'US'),
(3, 'AB', 'Alberta', 'CA'),
(4, 'AZ', 'Arizona', 'US'),
(5, 'AR', 'Arkansas', 'US'),
(6, 'BC', 'British Columbia', 'CA'),
(7, 'CA', 'California', 'US'),
(8, 'CO', 'Colorado', 'US'),
(9, 'CT', 'Connecticut', 'US'),
(10, 'DE', 'Delaware', 'US'),
(11, 'DC', 'District of Columbia', 'US'),
(12, 'FL', 'Florida', 'US'),
(13, 'GA', 'Georgia', 'US'),
(14, 'HI', 'Hawaii', 'US'),
(15, 'ID', 'Idaho', 'US'),
(16, 'IL', 'Illinois', 'US'),
(17, 'IN', 'Indiana', 'US'),
(18, 'IA', 'Iowa', 'US'),
(19, 'KS', 'Kansas', 'US'),
(20, 'KY', 'Kentucky', 'US'),
(21, 'LA', 'Louisiana', 'US'),
(22, 'ME', 'Maine', 'US'),
(23, 'MB', 'Manitoba', 'CA'),
(24, 'MD', 'Maryland', 'US'),
(25, 'MA', 'Massachusetts', 'US'),
(26, 'MI', 'Michigan', 'US'),
(27, 'MN', 'Minnesota', 'US'),
(28, 'MS', 'Mississippi', 'US'),
(29, 'MO', 'Missouri', 'US'),
(30, 'MT', 'Montana', 'US'),
(31, 'NE', 'Nebraska', 'US'),
(32, 'NV', 'Nevada', 'US'),
(33, 'NB', 'New Brunswick', 'CA'),
(34, 'NF', 'Newfoundland', 'CA'),
(35, 'NH', 'New Hampshire', 'US'),
(36, 'NJ', 'New Jersey', 'US'),
(37, 'NM', 'New Mexico', 'US'),
(38, 'NY', 'New York', 'US'),
(39, 'NC', 'North Carolina', 'US'),
(40, 'ND', 'North Dakota', 'US'),
(41, 'NS', 'Nova Scotia', 'CA'),
(42, 'OH', 'Ohio', 'US'),
(43, 'OK', 'Oklahoma', 'US'),
(44, 'ON', 'Ontario', 'CA'),
(45, 'OR', 'Oregon', 'US'),
(46, 'PA', 'Pennsylvania', 'US'),
(47, 'PE', 'Prince Edward Island', 'CA'),
(48, 'QC', 'Quebec', 'CA'),
(49, 'RI', 'Rhode Island', 'US'),
(50, 'SK', 'Saskatchewan', 'CA'),
(51, 'SC', 'South Carolina', 'US'),
(52, 'SD', 'South Dakota', 'US'),
(53, 'TN', 'Tennessee', 'US'),
(54, 'TX', 'Texas', 'US'),
(55, 'UT', 'Utah', 'US'),
(56, 'VT', 'Vermont', 'US'),
(57, 'VA', 'Virginia', 'US'),
(58, 'WA', 'Washington', 'US'),
(59, 'WV', 'West Virginia', 'US'),
(60, 'WI', 'Wisconsin', 'US'),
(61, 'WY', 'Wyoming', 'US'),
(62, 'NA', 'None of These', 'NA');

-- --------------------------------------------------------

--
-- Table structure for table `state_prov_codes`
--

CREATE TABLE IF NOT EXISTS `state_prov_codes` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `code` char(2) NOT NULL DEFAULT '',
  `state_prov` text NOT NULL,
  `country` char(2) NOT NULL DEFAULT 'US',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `state_prov_codes`
--

INSERT INTO `state_prov_codes` (`id`, `code`, `state_prov`, `country`) VALUES
(1, 'AL', 'Alabama', 'US'),
(2, 'AK', 'Alaska', 'US'),
(3, 'AB', 'Alberta', 'CA'),
(4, 'AZ', 'Arizona', 'US'),
(5, 'AR', 'Arkansas', 'US'),
(6, 'BC', 'British Columbia', 'CA'),
(7, 'CA', 'California', 'US'),
(8, 'CO', 'Colorado', 'US'),
(9, 'CT', 'Connecticut', 'US'),
(10, 'DE', 'Delaware', 'US'),
(11, 'DC', 'District of Columbia', 'US'),
(12, 'FL', 'Florida', 'US'),
(13, 'GA', 'Georgia', 'US'),
(14, 'HI', 'Hawaii', 'US'),
(15, 'ID', 'Idaho', 'US'),
(16, 'IL', 'Illinois', 'US'),
(17, 'IN', 'Indiana', 'US'),
(18, 'IA', 'Iowa', 'US'),
(19, 'KS', 'Kansas', 'US'),
(20, 'KY', 'Kentucky', 'US'),
(21, 'LA', 'Louisiana', 'US'),
(22, 'ME', 'Maine', 'US'),
(23, 'MB', 'Manitoba', 'CA'),
(24, 'MD', 'Maryland', 'US'),
(25, 'MA', 'Massachusetts', 'US'),
(26, 'MI', 'Michigan', 'US'),
(27, 'MN', 'Minnesota', 'US'),
(28, 'MS', 'Mississippi', 'US'),
(29, 'MO', 'Missouri', 'US'),
(30, 'MT', 'Montana', 'US'),
(31, 'NE', 'Nebraska', 'US'),
(32, 'NV', 'Nevada', 'US'),
(33, 'NB', 'New Brunswick', 'CA'),
(34, 'NF', 'Newfoundland', 'CA'),
(35, 'NH', 'New Hampshire', 'US'),
(36, 'NJ', 'New Jersey', 'US'),
(37, 'NM', 'New Mexico', 'US'),
(38, 'NY', 'New York', 'US'),
(39, 'NC', 'North Carolina', 'US'),
(40, 'ND', 'North Dakota', 'US'),
(41, 'NS', 'Nova Scotia', 'CA'),
(42, 'OH', 'Ohio', 'US'),
(43, 'OK', 'Oklahoma', 'US'),
(44, 'ON', 'Ontario', 'CA'),
(45, 'OR', 'Oregon', 'US'),
(46, 'PA', 'Pennsylvania', 'US'),
(47, 'PE', 'Prince Edward Island', 'CA'),
(48, 'QC', 'Quebec', 'CA'),
(49, 'RI', 'Rhode Island', 'US'),
(50, 'SK', 'Saskatchewan', 'CA'),
(51, 'SC', 'South Carolina', 'US'),
(52, 'SD', 'South Dakota', 'US'),
(53, 'TN', 'Tennessee', 'US'),
(54, 'TX', 'Texas', 'US'),
(55, 'UT', 'Utah', 'US'),
(56, 'VT', 'Vermont', 'US'),
(57, 'VA', 'Virginia', 'US'),
(58, 'WA', 'Washington', 'US'),
(59, 'WV', 'West Virginia', 'US'),
(60, 'WI', 'Wisconsin', 'US'),
(61, 'WY', 'Wyoming', 'US'),
(62, 'NA', 'None of These', 'NA');

-- --------------------------------------------------------

--
-- Table structure for table `test-vendor_masters_purchase`
--

CREATE TABLE IF NOT EXISTS `test-vendor_masters_purchase` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(200) NOT NULL,
  `material` varchar(200) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `added_date` date NOT NULL,
  `po_no` varchar(40) NOT NULL,
  `added_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `added_by_type` int(11) NOT NULL,
  `modified_by_type` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '''1->ative'',''0->inactive''',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1->deleted;0->not deleted',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_id` int(11) DEFAULT '1' COMMENT 'Default 1 => Super admin',
  `branch_id` int(11) unsigned DEFAULT NULL COMMENT '"In case of Branch Admin otherwise NULL"',
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `address_line1` varchar(255) NOT NULL,
  `address_line2` varchar(255) NOT NULL,
  `entry_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) unsigned NOT NULL DEFAULT '1' COMMENT '1=> Active, 0 => Inactive',
  `is_deleted` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '0 => Not Deleted, 1 => Deleted ',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indx_email` (`email`),
  KEY `fk_user_type_id` (`user_type_id`),
  KEY `branch_id` (`branch_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type_id`, `branch_id`, `first_name`, `last_name`, `user_name`, `password`, `email`, `phone`, `address_line1`, `address_line2`, `entry_ts`, `status`, `is_deleted`, `created`, `modified`) VALUES
(1, 1, NULL, 'Superadmin', 'Tridev', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@tridev.com', '12345678', '', '', '2014-04-14 23:41:57', 1, 0, '2014-04-15 00:00:00', '2014-09-21 14:58:02'),
(32, 2, NULL, 'Rahul', 'Dhman', 'rahula', '96e79218965eb72c92a549dd5a330112', 'rahuld@gmail.com', '34545435454', '', '', '2014-07-21 23:02:19', 1, 0, '2014-07-22 10:02:19', '2014-09-21 14:39:25'),
(33, 3, NULL, 'Rahul', 'Dhiman', 'rahulp', '96e79218965eb72c92a549dd5a330112', 'rahuld.ran19@gmail.com', '44444444444', '', '', '2014-08-24 04:43:49', 1, 0, '2014-08-24 15:43:49', '2014-09-21 14:50:09'),
(34, 4, NULL, 'Rohan', 'Kumar', 'rahullo', '96e79218965eb72c92a549dd5a330112', 'rahuld.ajay16@gmail.com', '44444444444444', '', '', '2014-08-24 06:00:53', 1, 0, '2014-08-24 17:00:53', '2014-09-21 14:55:17');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE IF NOT EXISTS `user_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_active` tinyint(4) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `name`, `is_active`) VALUES
(1, 'Super Admin', 1),
(2, 'Account Manager', 1),
(3, 'Purchase Manager', 1),
(4, 'Logistic Manager', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE IF NOT EXISTS `vendors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `added_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `added_by_type` int(11) NOT NULL,
  `modified_by_type` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '''1->ative'',''0->inactive''',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1->deleted;0->not deleted',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `sn` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(150) NOT NULL,
  `district` varchar(150) NOT NULL,
  `state` varchar(150) NOT NULL,
  `pin` varchar(10) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `vendor_type` varchar(50) NOT NULL,
  `cst_no` varchar(50) NOT NULL,
  `add_date` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `vat_reg_no` varchar(50) NOT NULL,
  `ecc_no` varchar(50) NOT NULL,
  `exice_reg_no` varchar(50) NOT NULL,
  `pan_no` varchar(50) NOT NULL,
  `service_tax_no` varchar(50) NOT NULL,
  `tan_no` varchar(50) NOT NULL,
  `ssi_no` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `added_by`, `modified_by`, `added_by_type`, `modified_by_type`, `status`, `is_deleted`, `created`, `modified`, `sn`, `name`, `code`, `address`, `street`, `city`, `district`, `state`, `pin`, `phone`, `mobile`, `vendor_type`, `cst_no`, `add_date`, `email`, `vat_reg_no`, `ecc_no`, `exice_reg_no`, `pan_no`, `service_tax_no`, `tan_no`, `ssi_no`) VALUES
(1, 1, 1, 1, 1, 1, 0, '2014-09-28 10:27:13', '2014-09-28 10:27:13', '123', 'Samsung', 'SAM123', '#452, Okhla', 'GT', 'Noida', 'Noida', 'UP', '45671', '(444) 444-4444', '(555) 555-5555', 'Business', '456', '2014-09-12', 'sam@gmail.com', '1235897', '6598754', '4569852', '126549823', '3168712', '15349853', '153463132'),
(2, 1, 1, 1, 1, 1, 0, '2014-09-28 10:29:14', '2014-09-28 10:29:14', '6789', 'Surya', 'SURYA123', '#452', 'MOP', 'Alaska', 'Norty', 'Verginia', '789546', '(111) 111-1111', '(999) 999-9999', 'Sales', '456', '2014-09-04', 'surya@yahoo.com', '77777', '888888', '999999', '999999', '777777', '7745454', '5545445');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_masters`
--

CREATE TABLE IF NOT EXISTS `vendor_masters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `expense_type` varchar(100) NOT NULL,
  `vendor_id` bigint(20) unsigned NOT NULL,
  `material` varchar(200) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `added_date` date NOT NULL,
  `po_no` varchar(40) NOT NULL,
  `added_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `added_by_type` int(11) NOT NULL,
  `modified_by_type` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '''1->ative'',''0->inactive''',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1->deleted;0->not deleted',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `vendor_masters`
--

INSERT INTO `vendor_masters` (`id`, `expense_type`, `vendor_id`, `material`, `quantity`, `price`, `amount`, `added_date`, `po_no`, `added_by`, `modified_by`, `added_by_type`, `modified_by_type`, `status`, `is_deleted`, `created`, `modified`) VALUES
(1, 'Fix', 1, 'Raw data', 12, '56.68', '680.14', '2014-09-10', '123', 32, 32, 2, 2, 1, 0, '2014-09-28 10:44:39', '2014-09-28 10:44:39');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_master_purchases`
--

CREATE TABLE IF NOT EXISTS `vendor_master_purchases` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint(20) unsigned NOT NULL,
  `material` varchar(200) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `added_date` date NOT NULL,
  `po_no` varchar(40) NOT NULL,
  `added_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `added_by_type` int(11) NOT NULL,
  `modified_by_type` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '''1->ative'',''0->inactive''',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1->deleted;0->not deleted',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `vendor_master_purchases`
--

INSERT INTO `vendor_master_purchases` (`id`, `vendor_id`, `material`, `quantity`, `price`, `amount`, `added_date`, `po_no`, `added_by`, `modified_by`, `added_by_type`, `modified_by_type`, `status`, `is_deleted`, `created`, `modified`) VALUES
(1, 1, 'Electric wire', 67, '890.00', '59630.00', '2014-09-24', '124', 33, 33, 3, 3, 1, 0, '2014-09-28 10:48:51', '2014-09-28 10:48:51'),
(2, 2, 'Glaxy', 12, '234.00', '2808.00', '2014-09-17', '345', 33, 33, 3, 3, 1, 0, '2014-09-28 10:57:34', '2014-09-28 10:57:34');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
