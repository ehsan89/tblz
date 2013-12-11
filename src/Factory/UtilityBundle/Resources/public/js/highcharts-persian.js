/*
 Highcharts JS v3.0.7 (2013-10-24) Persian Extension

 (c) 2009-2013 Torstein Hønsi

 License: www.highcharts.com/license
 */

function setPersianDefaults() {
	var monthNames = [ "فروردين", "ارديبهشت", "خرداد", "تير", "مرداد", "شهريور",
			"مهر", "آبان", "آذر", "دي", "بهمن", "اسفند" ];
	var dayNames = [ "شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنجشنبه",
			"جمعه" ];
	function zeroPad(number) {
		return ("0" + number).substr(-2, 2);
	}
	
	/**
	 * Add custom date formats
	 */
	Highcharts.dateFormats = {
		fd : function(timestamp) {
			var date = new Date(timestamp);
			var pdate = new PersianDate(date);
			return zeroPad(pdate.getDate());
		},
		fm : function(timestamp) {
			var date = new Date(timestamp);
			var pdate = new PersianDate(date);
			return zeroPad(pdate.getMonth() + 1);
		},
		fn : function(timestamp) {
			var date = new Date(timestamp);
			var pdate = new PersianDate(date);
			return monthNames[pdate.getMonth()];
		},
		fw : function(timestamp) {
			var date = new Date(timestamp);
			var pdate = new PersianDate(date);
			return dayNames[pdate.getDay()];
		},
		fy : function(timestamp) {
			var date = new Date(timestamp);
			var pdate = new PersianDate(date);
			return pdate.getFullYear();
		},
		fY : function(timestamp) {
			var date = new Date(timestamp);
			var pdate = new PersianDate(date);
			return String(pdate.getFullYear()).substr(2,2);
		}
	};
	
	Highcharts.setOptions({
		lang : {
			resetZoom : 'حالت زوم اولیه',
			resetZoomTitle : 'حالت زوم اولیه'
		}
	});
}