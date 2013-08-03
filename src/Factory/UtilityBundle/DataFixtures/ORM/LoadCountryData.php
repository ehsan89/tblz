<?php
namespace Factory\UtilityBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Factory\UtilityBundle\Entity\Country;

class LoadCountryData implements FixtureInterface {
	/**
	 * {@inheritDoc}
	 */
	public function load(ObjectManager $manager) {

		$country = new Country();
		$country->setName('آذربایجان');
		$country->setCode('AZ');
		$manager->persist($country);

		$country = new Country();
		$country->setName('آرژانتین');
		$country->setCode('AR');
		$manager->persist($country);

		$country = new Country();
		$country->setName('آفریقای جنوبی');
		$country->setCode('ZA');
		$manager->persist($country);

		$country = new Country();
		$country->setName('آفریقای مرکزی');
		$country->setCode('CF');
		$manager->persist($country);

		$country = new Country();
		$country->setName('آلبانی');
		$country->setCode('AL');
		$manager->persist($country);

		$country = new Country();
		$country->setName('آلمان');
		$country->setCode('DE');
		$manager->persist($country);

		$country = new Country();
		$country->setName('آنتیگوا و باربودا');
		$country->setCode('AG');
		$manager->persist($country);

		$country = new Country();
		$country->setName('آندورا');
		$country->setCode('AD');
		$manager->persist($country);

		$country = new Country();
		$country->setName('آنگولا');
		$country->setCode('AO');
		$manager->persist($country);

		$country = new Country();
		$country->setName('اتریش');
		$country->setCode('AT');
		$manager->persist($country);

		$country = new Country();
		$country->setName('اتیوپی');
		$country->setCode('ET');
		$manager->persist($country);

		$country = new Country();
		$country->setName('اردن');
		$country->setCode('JO');
		$manager->persist($country);

		$country = new Country();
		$country->setName('ارمنستان');
		$country->setCode('AM');
		$manager->persist($country);

		$country = new Country();
		$country->setName('اروگوئه');
		$country->setCode('UY');
		$manager->persist($country);

		$country = new Country();
		$country->setName('اريتره');
		$country->setCode('ER');
		$manager->persist($country);

		$country = new Country();
		$country->setName('ازبکستان');
		$country->setCode('UZ');
		$manager->persist($country);

		$country = new Country();
		$country->setName('اسپانیا');
		$country->setCode('ES');
		$manager->persist($country);

		$country = new Country();
		$country->setName('استرالیا');
		$country->setCode('AU');
		$manager->persist($country);

		$country = new Country();
		$country->setName('استونی');
		$country->setCode('EE');
		$manager->persist($country);

		$country = new Country();
		$country->setName('اسرائیل');
		$country->setCode('IL');
		$manager->persist($country);

		$country = new Country();
		$country->setName('اسلواکی');
		$country->setCode('SK');
		$manager->persist($country);

		$country = new Country();
		$country->setName('اسلوونی');
		$country->setCode('SI');
		$manager->persist($country);

		$country = new Country();
		$country->setName('افغانستان');
		$country->setCode('AF');
		$manager->persist($country);

		$country = new Country();
		$country->setName('اکوادور');
		$country->setCode('EC');
		$manager->persist($country);

		$country = new Country();
		$country->setName('الجزایر');
		$country->setCode('DZ');
		$manager->persist($country);

		$country = new Country();
		$country->setName('السالوادور');
		$country->setCode('SV');
		$manager->persist($country);

		$country = new Country();
		$country->setName('امارات متحده عربی');
		$country->setCode('AE');
		$manager->persist($country);

		$country = new Country();
		$country->setName('اندونزی');
		$country->setCode('ID');
		$manager->persist($country);

		$country = new Country();
		$country->setName('اوکراین');
		$country->setCode('UA');
		$manager->persist($country);

		$country = new Country();
		$country->setName('اوگاندا');
		$country->setCode('UG');
		$manager->persist($country);

		$country = new Country();
		$country->setName('ایالات متحده آمریکا');
		$country->setCode('US');
		$manager->persist($country);

		$country = new Country();
		$country->setName('ایتالیا');
		$country->setCode('IT');
		$manager->persist($country);

		$country = new Country();
		$country->setName('ایران');
		$country->setCode('IR');
		$manager->persist($country);

		$country = new Country();
		$country->setName('ایرلند');
		$country->setCode('IE');
		$manager->persist($country);

		$country = new Country();
		$country->setName('ایسلند');
		$country->setCode('IS');
		$manager->persist($country);

		$country = new Country();
		$country->setName('باربادوس');
		$country->setCode('BB');
		$manager->persist($country);

		$country = new Country();
		$country->setName('باهاما');
		$country->setCode('BS');
		$manager->persist($country);

		$country = new Country();
		$country->setName('بحرین');
		$country->setCode('BH');
		$manager->persist($country);

		$country = new Country();
		$country->setName('برزیل');
		$country->setCode('BR');
		$manager->persist($country);

		$country = new Country();
		$country->setName('برونئی');
		$country->setCode('BN');
		$manager->persist($country);

		$country = new Country();
		$country->setName('بریتانیا');
		$country->setCode('GB');
		$manager->persist($country);

		$country = new Country();
		$country->setName('بلاروس');
		$country->setCode('BY');
		$manager->persist($country);

		$country = new Country();
		$country->setName('بلژیک');
		$country->setCode('BE');
		$manager->persist($country);

		$country = new Country();
		$country->setName('بلغارستان');
		$country->setCode('BG');
		$manager->persist($country);

		$country = new Country();
		$country->setName('بلیز');
		$country->setCode('BZ');
		$manager->persist($country);

		$country = new Country();
		$country->setName('بنگلادش');
		$country->setCode('BD');
		$manager->persist($country);

		$country = new Country();
		$country->setName('بنین');
		$country->setCode('BJ');
		$manager->persist($country);

		$country = new Country();
		$country->setName('بوتان');
		$country->setCode('BT');
		$manager->persist($country);

		$country = new Country();
		$country->setName('بوتسوانا');
		$country->setCode('BW');
		$manager->persist($country);

		$country = new Country();
		$country->setName('بورکینافاسو');
		$country->setCode('BF');
		$manager->persist($country);

		$country = new Country();
		$country->setName('بوروندی');
		$country->setCode('BI');
		$manager->persist($country);

		$country = new Country();
		$country->setName('بوسنی هرزگووین');
		$country->setCode('BA');
		$manager->persist($country);

		$country = new Country();
		$country->setName('بولیوی');
		$country->setCode('BO');
		$manager->persist($country);

		$country = new Country();
		$country->setName('پاپوا گینه نو');
		$country->setCode('PG');
		$manager->persist($country);

		$country = new Country();
		$country->setName('پاراگوئه');
		$country->setCode('PY');
		$manager->persist($country);

		$country = new Country();
		$country->setName('پاناما');
		$country->setCode('PA');
		$manager->persist($country);

		$country = new Country();
		$country->setName('پاکستان');
		$country->setCode('PK');
		$manager->persist($country);

		$country = new Country();
		$country->setName('پرتغال');
		$country->setCode('PT');
		$manager->persist($country);

		$country = new Country();
		$country->setName('پرو');
		$country->setCode('PE');
		$manager->persist($country);

		$country = new Country();
		$country->setName('پورتوریکو');
		$country->setCode('PR');
		$manager->persist($country);

		$country = new Country();
		$country->setName('تاجیکستان');
		$country->setCode('TJ');
		$manager->persist($country);

		$country = new Country();
		$country->setName('تانزانیا');
		$country->setCode('TZ');
		$manager->persist($country);

		$country = new Country();
		$country->setName('تایلند');
		$country->setCode('TH');
		$manager->persist($country);

		$country = new Country();
		$country->setName('تایوان');
		$country->setCode('TW');
		$manager->persist($country);

		$country = new Country();
		$country->setName('ترکمنستان');
		$country->setCode('TM');
		$manager->persist($country);

		$country = new Country();
		$country->setName('ترکیه');
		$country->setCode('TR');
		$manager->persist($country);

		$country = new Country();
		$country->setName('ترینیداد و توباگو');
		$country->setCode('TT');
		$manager->persist($country);

		$country = new Country();
		$country->setName('توگو');
		$country->setCode('TG');
		$manager->persist($country);

		$country = new Country();
		$country->setName('تونس');
		$country->setCode('TN');
		$manager->persist($country);

		$country = new Country();
		$country->setName('تونگا');
		$country->setCode('TO');
		$manager->persist($country);

		$country = new Country();
		$country->setName('تووالو');
		$country->setCode('TV');
		$manager->persist($country);

		$country = new Country();
		$country->setName('تیمور شرقی');
		$country->setCode('TL');
		$manager->persist($country);

		$country = new Country();
		$country->setName('جامائیکا');
		$country->setCode('JM');
		$manager->persist($country);

		$country = new Country();
		$country->setName('جزایر سلیمان');
		$country->setCode('SB');
		$manager->persist($country);

		$country = new Country();
		$country->setName('جزایر مارشال');
		$country->setCode('MH');
		$manager->persist($country);

		$country = new Country();
		$country->setName('جمهوری چک');
		$country->setCode('CZ');
		$manager->persist($country);

		$country = new Country();
		$country->setName('جمهوری خلق چین');
		$country->setCode('CN');
		$manager->persist($country);

		$country = new Country();
		$country->setName('جمهوری خلق کنگو(زئیر)');
		$country->setCode('CD');
		$manager->persist($country);

		$country = new Country();
		$country->setName('جمهوری دومینیکن');
		$country->setCode('DO');
		$manager->persist($country);

		$country = new Country();
		$country->setName('جیبوتی');
		$country->setCode('DJ');
		$manager->persist($country);

		$country = new Country();
		$country->setName('چاد');
		$country->setCode('TD');
		$manager->persist($country);

		$country = new Country();
		$country->setName('دانمارک');
		$country->setCode('DK');
		$manager->persist($country);

		$country = new Country();
		$country->setName('دومینیکا');
		$country->setCode('DM');
		$manager->persist($country);

		$country = new Country();
		$country->setName('رواندا');
		$country->setCode('RW');
		$manager->persist($country);

		$country = new Country();
		$country->setName('روسیه');
		$country->setCode('RU');
		$manager->persist($country);

		$country = new Country();
		$country->setName('رومانی');
		$country->setCode('RO');
		$manager->persist($country);

		$country = new Country();
		$country->setName('زامبیا');
		$country->setCode('ZM');
		$manager->persist($country);

		$country = new Country();
		$country->setName('زلاند نو');
		$country->setCode('NZ');
		$manager->persist($country);

		$country = new Country();
		$country->setName('زیمبابوه');
		$country->setCode('ZW');
		$manager->persist($country);

		$country = new Country();
		$country->setName('ژاپن');
		$country->setCode('JP');
		$manager->persist($country);

		$country = new Country();
		$country->setName('سائوتومه و پرنسیپ');
		$country->setCode('ST');
		$manager->persist($country);

		$country = new Country();
		$country->setName('ساحل عاج');
		$country->setCode('CI');
		$manager->persist($country);

		$country = new Country();
		$country->setName('ساموآی غربی');
		$country->setCode('AS');
		$manager->persist($country);

		$country = new Country();
		$country->setName('سان مارینو');
		$country->setCode('SM');
		$manager->persist($country);

		$country = new Country();
		$country->setName('سری‌لانکا');
		$country->setCode('LK');
		$manager->persist($country);

		$country = new Country();
		$country->setName('سنت کیتس و نویس');
		$country->setCode('KN');
		$manager->persist($country);

		$country = new Country();
		$country->setName('سنگاپور');
		$country->setCode('SG');
		$manager->persist($country);

		$country = new Country();
		$country->setName('سنگال');
		$country->setCode('SN');
		$manager->persist($country);

		$country = new Country();
		$country->setName('سوئد');
		$country->setCode('SE');
		$manager->persist($country);

		$country = new Country();
		$country->setName('سوئیس');
		$country->setCode('CH');
		$manager->persist($country);

		$country = new Country();
		$country->setName('سوازیلند');
		$country->setCode('SZ');
		$manager->persist($country);

		$country = new Country();
		$country->setName('سودان');
		$country->setCode('SD');
		$manager->persist($country);

		$country = new Country();
		$country->setName('سورینام');
		$country->setCode('SR');
		$manager->persist($country);

		$country = new Country();
		$country->setName('سوریه');
		$country->setCode('SY');
		$manager->persist($country);

		$country = new Country();
		$country->setName('سومالی');
		$country->setCode('SO');
		$manager->persist($country);

		$country = new Country();
		$country->setName('سیرالئون');
		$country->setCode('SL');
		$manager->persist($country);

		$country = new Country();
		$country->setName('سیشل');
		$country->setCode('SC');
		$manager->persist($country);

		$country = new Country();
		$country->setName('شیلی');
		$country->setCode('CL');
		$manager->persist($country);

		$country = new Country();
		$country->setName('صربستان');
		$country->setCode('SP');
		$manager->persist($country);

		$country = new Country();
		$country->setName('عراق');
		$country->setCode('IQ');
		$manager->persist($country);

		$country = new Country();
		$country->setName('عربستان سعودی');
		$country->setCode('SA');
		$manager->persist($country);

		$country = new Country();
		$country->setName('عمان');
		$country->setCode('OM');
		$manager->persist($country);

		$country = new Country();
		$country->setName('غنا');
		$country->setCode('GH');
		$manager->persist($country);

		$country = new Country();
		$country->setName('فرانسه');
		$country->setCode('FR');
		$manager->persist($country);

		$country = new Country();
		$country->setName('فلسطین');
		$country->setCode('FL');
		$manager->persist($country);

		$country = new Country();
		$country->setName('فنلاند');
		$country->setCode('FI');
		$manager->persist($country);

		$country = new Country();
		$country->setName('فیجی');
		$country->setCode('FJ');
		$manager->persist($country);

		$country = new Country();
		$country->setName('فیلیپین');
		$country->setCode('PH');
		$manager->persist($country);

		$country = new Country();
		$country->setName('قبرس');
		$country->setCode('CY');
		$manager->persist($country);

		$country = new Country();
		$country->setName('قرقیزستان');
		$country->setCode('KG');
		$manager->persist($country);

		$country = new Country();
		$country->setName('قزاقستان');
		$country->setCode('KZ');
		$manager->persist($country);

		$country = new Country();
		$country->setName('قطر');
		$country->setCode('QA');
		$manager->persist($country);

		$country = new Country();
		$country->setName('کامبوج');
		$country->setCode('KH');
		$manager->persist($country);

		$country = new Country();
		$country->setName('کامرون');
		$country->setCode('CM');
		$manager->persist($country);

		$country = new Country();
		$country->setName('کانادا');
		$country->setCode('CA');
		$manager->persist($country);

		$country = new Country();
		$country->setName('کره جنوبی');
		$country->setCode('KR');
		$manager->persist($country);

		$country = new Country();
		$country->setName('کره شمالی');
		$country->setCode('KP');
		$manager->persist($country);

		$country = new Country();
		$country->setName('کرواسی');
		$country->setCode('HR');
		$manager->persist($country);

		$country = new Country();
		$country->setName('کاستاریکا');
		$country->setCode('CR');
		$manager->persist($country);

		$country = new Country();
		$country->setName('کلمبیا');
		$country->setCode('CO');
		$manager->persist($country);

		$country = new Country();
		$country->setName('کنگو');
		$country->setCode('CG');
		$manager->persist($country);

		$country = new Country();
		$country->setName('کنیا');
		$country->setCode('KE');
		$manager->persist($country);

		$country = new Country();
		$country->setName('کوبا');
		$country->setCode('CU');
		$manager->persist($country);

		$country = new Country();
		$country->setName('کومور');
		$country->setCode('KM');
		$manager->persist($country);

		$country = new Country();
		$country->setName('کویت');
		$country->setCode('KW');
		$manager->persist($country);

		$country = new Country();
		$country->setName('کیپ ورد');
		$country->setCode('CV');
		$manager->persist($country);

		$country = new Country();
		$country->setName('کیریباتی');
		$country->setCode('KI');
		$manager->persist($country);

		$country = new Country();
		$country->setName('گابن');
		$country->setCode('GA');
		$manager->persist($country);

		$country = new Country();
		$country->setName('گامبیا');
		$country->setCode('GM');
		$manager->persist($country);

		$country = new Country();
		$country->setName('گرجستان');
		$country->setCode('GE');
		$manager->persist($country);

		$country = new Country();
		$country->setName('گرنادا');
		$country->setCode('GD');
		$manager->persist($country);

		$country = new Country();
		$country->setName('گرینلند');
		$country->setCode('GL');
		$manager->persist($country);

		$country = new Country();
		$country->setName('گوآتمالا');
		$country->setCode('GT');
		$manager->persist($country);

		$country = new Country();
		$country->setName('گویان');
		$country->setCode('GF');
		$manager->persist($country);

		$country = new Country();
		$country->setName('گینه');
		$country->setCode('GN');
		$manager->persist($country);

		$country = new Country();
		$country->setName('گینه استوایی');
		$country->setCode('GQ');
		$manager->persist($country);

		$country = new Country();
		$country->setName('گینه بیسائو');
		$country->setCode('GW');
		$manager->persist($country);

		$country = new Country();
		$country->setName('لائوس');
		$country->setCode('LA');
		$manager->persist($country);

		$country = new Country();
		$country->setName('لبنان');
		$country->setCode('LB');
		$manager->persist($country);

		$country = new Country();
		$country->setName('لتونی');
		$country->setCode('LV');
		$manager->persist($country);

		$country = new Country();
		$country->setName('لسوتو');
		$country->setCode('LS');
		$manager->persist($country);

		$country = new Country();
		$country->setName('لهستان');
		$country->setCode('PL');
		$manager->persist($country);

		$country = new Country();
		$country->setName('لوکزامبورگ');
		$country->setCode('LU');
		$manager->persist($country);

		$country = new Country();
		$country->setName('لیبریا');
		$country->setCode('LR');
		$manager->persist($country);

		$country = new Country();
		$country->setName('لیبی');
		$country->setCode('LY');
		$manager->persist($country);

		$country = new Country();
		$country->setName('لیتوانی');
		$country->setCode('LT');
		$manager->persist($country);

		$country = new Country();
		$country->setName('لیختنشتاین');
		$country->setCode('LI');
		$manager->persist($country);

		$country = new Country();
		$country->setName('ماداگاسکار');
		$country->setCode('MG');
		$manager->persist($country);

		$country = new Country();
		$country->setName('مالاوی');
		$country->setCode('MW');
		$manager->persist($country);

		$country = new Country();
		$country->setName('مالت');
		$country->setCode('MT');
		$manager->persist($country);

		$country = new Country();
		$country->setName('مالدیو');
		$country->setCode('MV');
		$manager->persist($country);

		$country = new Country();
		$country->setName('مالزی');
		$country->setCode('MY');
		$manager->persist($country);

		$country = new Country();
		$country->setName('مالی');
		$country->setCode('ML');
		$manager->persist($country);

		$country = new Country();
		$country->setName('مجارستان');
		$country->setCode('HU');
		$manager->persist($country);

		$country = new Country();
		$country->setName('مراکش');
		$country->setCode('MA');
		$manager->persist($country);

		$country = new Country();
		$country->setName('مصر');
		$country->setCode('EG');
		$manager->persist($country);

		$country = new Country();
		$country->setName('مغولستان');
		$country->setCode('MN');
		$manager->persist($country);

		$country = new Country();
		$country->setName('مقدونیه');
		$country->setCode('MK');
		$manager->persist($country);

		$country = new Country();
		$country->setName('مکزیک');
		$country->setCode('MX');
		$manager->persist($country);

		$country = new Country();
		$country->setName('موریتانی');
		$country->setCode('MR');
		$manager->persist($country);

		$country = new Country();
		$country->setName('موریس');
		$country->setCode('MU');
		$manager->persist($country);

		$country = new Country();
		$country->setName('موزامبیک');
		$country->setCode('MZ');
		$manager->persist($country);

		$country = new Country();
		$country->setName('مولداوی');
		$country->setCode('MD');
		$manager->persist($country);

		$country = new Country();
		$country->setName('موناکو');
		$country->setCode('MC');
		$manager->persist($country);

		$country = new Country();
		$country->setName('میانمار');
		$country->setCode('MM');
		$manager->persist($country);

		$country = new Country();
		$country->setName('میکرونزی');
		$country->setCode('FM');
		$manager->persist($country);

		$country = new Country();
		$country->setName('نائورو');
		$country->setCode('NR');
		$manager->persist($country);

		$country = new Country();
		$country->setName('نامیبیا');
		$country->setCode('NA');
		$manager->persist($country);

		$country = new Country();
		$country->setName('نپال');
		$country->setCode('NP');
		$manager->persist($country);

		$country = new Country();
		$country->setName('نروژ');
		$country->setCode('NO');
		$manager->persist($country);

		$country = new Country();
		$country->setName('نیجر');
		$country->setCode('NE');
		$manager->persist($country);

		$country = new Country();
		$country->setName('نیجریه');
		$country->setCode('NG');
		$manager->persist($country);

		$country = new Country();
		$country->setName('نیکاراگوآ');
		$country->setCode('NI');
		$manager->persist($country);

		$country = new Country();
		$country->setName('واتیکان');
		$country->setCode('VA');
		$manager->persist($country);

		$country = new Country();
		$country->setName('وانواتو');
		$country->setCode('VU');
		$manager->persist($country);

		$country = new Country();
		$country->setName('ونزوئلا');
		$country->setCode('VE');
		$manager->persist($country);

		$country = new Country();
		$country->setName('ویتنام');
		$country->setCode('VN');
		$manager->persist($country);

		$country = new Country();
		$country->setName('هائیتی');
		$country->setCode('HT');
		$manager->persist($country);

		$country = new Country();
		$country->setName('هلند');
		$country->setCode('NL');
		$manager->persist($country);

		$country = new Country();
		$country->setName('هندوراس');
		$country->setCode('HN');
		$manager->persist($country);

		$country = new Country();
		$country->setName('هندوستان');
		$country->setCode('IN');
		$manager->persist($country);

		$country = new Country();
		$country->setName('یونان');
		$country->setCode('GR');
		$manager->persist($country);

		$country = new Country();
		$country->setName('یمن');
		$country->setCode('YE');

		$manager->flush();
	}
}
