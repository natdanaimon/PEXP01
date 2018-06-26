function number_format(number, decimals, decPoint, thousandsSep) { // eslint-disable-line camelcase
    //  discuss at: http://locutus.io/php/number_format/
    // original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // improved by: Kevin van Zonneveld (http://kvz.io)
    // improved by: davook
    // improved by: Brett Zamir (http://brett-zamir.me)
    // improved by: Brett Zamir (http://brett-zamir.me)
    // improved by: Theriault (https://github.com/Theriault)
    // improved by: Kevin van Zonneveld (http://kvz.io)
    // bugfixed by: Michael White (http://getsprink.com)
    // bugfixed by: Benjamin Lupton
    // bugfixed by: Allan Jensen (http://www.winternet.no)
    // bugfixed by: Howard Yeend
    // bugfixed by: Diogo Resende
    // bugfixed by: Rival
    // bugfixed by: Brett Zamir (http://brett-zamir.me)
    //  revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    //  revised by: Luke Smith (http://lucassmith.name)
    //    input by: Kheang Hok Chin (http://www.distantia.ca/)
    //    input by: Jay Klehr
    //    input by: Amir Habibi (http://www.residence-mixte.com/)
    //    input by: Amirouche
    //   example 1: number_format(1234.56)
    //   returns 1: '1,235'
    //   example 2: number_format(1234.56, 2, ',', ' ')
    //   returns 2: '1 234,56'
    //   example 3: number_format(1234.5678, 2, '.', '')
    //   returns 3: '1234.57'
    //   example 4: number_format(67, 2, ',', '.')
    //   returns 4: '67,00'
    //   example 5: number_format(1000)
    //   returns 5: '1,000'
    //   example 6: number_format(67.311, 2)
    //   returns 6: '67.31'
    //   example 7: number_format(1000.55, 1)
    //   returns 7: '1,000.6'
    //   example 8: number_format(67000, 5, ',', '.')
    //   returns 8: '67.000,00000'
    //   example 9: number_format(0.9, 0)
    //   returns 9: '1'
    //  example 10: number_format('1.20', 2)
    //  returns 10: '1.20'
    //  example 11: number_format('1.20', 4)
    //  returns 11: '1.2000'
    //  example 12: number_format('1.2000', 3)
    //  returns 12: '1.200'
    //  example 13: number_format('1 000,50', 2, '.', ' ')
    //  returns 13: '100 050.00'
    //  example 14: number_format(1e-8, 8, '.', '')
    //  returns 14: '0.00000001'
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
    var n = !isFinite(+number) ? 0 : +number
    var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
    var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
    var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
    var s = ''
    var toFixedFix = function (n, prec) {
        var k = Math.pow(10, prec)
        return '' + (Math.round(n * k) / k)
                .toFixed(prec)
    }
    // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || ''
        s[1] += new Array(prec - s[1].length + 1).join('0')
    }
    return s.join(dec)
}



















/**
 * Thai translation for bootstrap-datepicker
 * Suchau Jiraprapot <seroz24@gmail.com>
 */
 
;(function($){
	// en-th - (rare use) english language with thai-year
	$.fn.datepicker.dates['en-th'] = 
	// en-en.th - english language with smart thai-year input (2540-2569) conversion 
	$.fn.datepicker.dates['en-en.th'] = 
							$.fn.datepicker.dates['en'];
	
	// th-th - thai language with thai-year
	$.fn.datepicker.dates['th-th'] =
	$.fn.datepicker.dates['th'] = {
		format: 'dd/mm/yyyy',
		days: ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัส", "ศุกร์", "เสาร์", "อาทิตย์"],
		daysShort: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส", "อา"],
		daysMin: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส", "อา"],
		months: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"],
		monthsShort: ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."],
		today: "วันนี้"
	};
}(jQuery));


/**
 * Implement Thai-year handling inherit core datepicker and default bootstrap-datepicker backend.
 */


;(function($) {
  var dates   = $.fn.datepicker.dates
    , DPGlobal= $.fn.datepicker.DPGlobal
    , thai    = { 
                  adj     : 543
                , code    : 'th'
                , bound   : 2400  // full year value that detect as thai year 
                , shbound : 40  // short year value that detect as thai year 
                , shwrap  : 84  // short year value that wrap to previous century
                , shbase  : 2000  // default base for short year 20xx
                }
                
  function dspThaiYear(language) {
    return language.search('-'+thai.code)>=0
  }
  
  function smartThai(language){
    return language.search(thai.code)>=0
  }
  
  function smartFullYear(v,language){
    if (smartThai(language) && v>=thai.bound) 
      v -= thai.adj // thaiyear 24xx -
    
    if (dspThaiYear(language) && v < thai.bound - thai.adj) 
      v -= thai.adj
    
    return v;
  }
  
  function smartShortYear(v,language) {
    if (v<100){
      if (v>=thai.shwrap) 
        v -= 100; // 1970 - 1999
        
      if (smartThai(language) && v>=thai.shbound) 
        v -= (thai.adj%100) // thaiyear [2540..2569] -> [1997..2026]

      v += thai.shbase;
    }
    return v;
  }
  
  function smartYear(v,language) {
    return smartFullYear(smartShortYear(v,language),language)
  }
  
  function UTCDate() {
    return new Date(Date.UTC.apply(Date, arguments))
  }

  // inherit default backend
  
  if (DPGlobal.name && DPGlobal.name.search(/.th$/)>=0)
    return
    
  var  _basebackend_ = $.extend({},DPGlobal)
  
  $.extend(DPGlobal,{
      name:       (_basebackend_.name || '') + '.th'
    , parseDate:  
        function(date, format, language) {
          if (date=='') {
            date = new Date()
            date = UTCDate(date.getFullYear(), date.getMonth(), date.getDate(), 0, 0, 0)
          }

          if (smartThai(language) 
          && !((date instanceof Date) || /^[-+].*/.test(date))) {
          
            var formats = format //this.parseFormat(format)
              , parts   = date && date.match(this.nonpunctuation) || []
            
            if (typeof formats === 'string')
              formats = DPGlobal.parseFormat(format);
            if (parts.length == formats.parts.length) {
              var seps  = $.extend([], formats.separators)
                , xdate = []
                
              for (var i=0, cnt = formats.parts.length; i < cnt; i++) {
                if (~['yyyy','yy'].indexOf(formats.parts[i]))
                  parts[i] = '' + smartYear(parseInt(parts[i], 10),language)
                  
                if (seps.length)
                  xdate.push(seps.shift())
                  
                xdate.push(parts[i])
              }
              
              date = xdate.join('')
            }
          }
          return _basebackend_.parseDate.call(this,date,format,language)
        }
    , formatDate: 
        function(date, format, language){
          var fmtdate = _basebackend_.formatDate.call(this,date,format,language)

          if (dspThaiYear(language)){
            var formats = format //this.parseFormat(format)
              , parts   = fmtdate && fmtdate.match(this.nonpunctuation) || []
              , trnfrm  = {
                  yy  : (thai.adj+date.getUTCFullYear()).toString().substring(2)
                , yyyy: (thai.adj+date.getUTCFullYear()).toString()
                }
                
            if (typeof formats === 'string')
              formats = DPGlobal.parseFormat(format);
              
            if (parts.length == formats.parts.length) {
              var seps  = $.extend([], formats.separators)
                , xdate = []
                
              for (var i=0, cnt = formats.parts.length; i < cnt; i++) {
                if (seps.length)
                  xdate.push(seps.shift())
                  
                xdate.push(trnfrm[formats.parts[i]] || parts[i])
              }
              fmtdate = xdate.join('')
            }
          
          }
          return fmtdate
        }
    })

  // inherit core datepicker
  var DatePicker = $.fn.datepicker.Constructor
  
  if (!DatePicker.prototype.fillThai){
    var _basemethod_ = $.extend({},DatePicker.prototype)
    
    $.extend(DatePicker.prototype,{
        fillThai: function(){
            var d         = new Date(this.viewDate)
              , year      = d.getUTCFullYear()
              , month     = d.getUTCMonth()
              , elem      = this.picker.find('.datepicker-days th:eq(1)')
              
            elem
              .text(elem.text()
              .replace(''+year,''+(year+thai.adj)))

            this.picker
              .find('.datepicker-months')
              .find('th:eq(1)')
              .text(''+(year+thai.adj))
              
            year = parseInt((year+thai.adj)/10, 10) * 10
            
            this.picker
              .find('.datepicker-years')
              .find('th:eq(1)')
              .text(year + '-' + (year + 9))
              .end()
              .find('td')
              .find('span.year')
              .each( 
                function() {
                  $(this)
                    .text(Number($(this).text()) + thai.adj)
                })
          }
      , fill: function(){
            _basemethod_.fill.call(this)
            
            if (dspThaiYear(this.o.language))
              this.fillThai()
          }
      , clickThai: function(e){
            var target  = $(e.target).closest('span')
            
            if (target.length === 1 && target.is('.year'))
              target.text(Number(target.text()) - thai.adj)
          }
      , click: function(e){
            if (dspThaiYear(this.o.language))
              this.clickThai(e)
              if(e.target.className=="datepicker-switch"){
            	  	return;
              }else{
            	   _basemethod_.click.call(this,e)
              }
           
          }
      , keydown: function(e){
            // allow arrow-down to show picker
            if (this.picker.is(':not(:visible)')
            && e.keyCode == 40 // arrow-down
            && $(e.target).is('[autocomplete="off"]')) {
                  this.show()
                  return;
            }
            _basemethod_.keydown.call(this,e)
          }
      , hide: function(e){
            // fix redundant hide in orginal code
            if (this.picker.is(':visible'))
              _basemethod_.hide.call(this,e)
            //else console.log('redundant hide')
          }
      
    })
  }
}(jQuery));


var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

function disableF5(e) {
	if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82){
		e.preventDefault();
	}  
	document.oncontextmenu = function() {return false;}; 
}

function disableRightClick(){
	 document.addEventListener('contextmenu', event => event.preventDefault());
}

function removeUrlAllParam(){
	window.history.replaceState(null, null, window.location.pathname);
}

function BlockReload(){
	 $(document).on("keydown", disableF5);
	 disableRightClick();
}



